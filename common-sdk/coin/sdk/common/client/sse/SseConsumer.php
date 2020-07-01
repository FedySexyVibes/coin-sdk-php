<?php

namespace coin\sdk\common\client\sse;

use coin\sdk\common\client\RestApiClient;
use coin\sdk\common\crypto\ApiClientUtil;
use Exception;
use Generator;
use GuzzleHttp;
use GuzzleHttp\Exception\ConnectException;
use Spatie\Enum\Enum;

class SseConsumer extends RestApiClient
{
    private $sseUri;
    private $backOffPeriod;
    private $numberOfRetries;

    private $retriesLeft;
    private $currentBackOffValue;
    private $offset;

    private $running;

    /**
     * NumberPortabilityMessageConsumer constructor.
     * @param string $sseUri
     * @param string $consumerName [optional]
     * @param string $privateKeyFile [optional]
     * @param string $encryptedHmacSecretFile [optional]
     * @param int $backOffPeriod [optional]
     * @param int $numberOfRetries [optional]
     */
    function __construct($sseUri, $consumerName = null, $privateKeyFile = null, $encryptedHmacSecretFile = null,
                         $backOffPeriod = 1, $numberOfRetries = 20)
    {
        parent::__construct($consumerName, $privateKeyFile, $encryptedHmacSecretFile);
        $this->sseUri = $sseUri;
        $this->backOffPeriod = $backOffPeriod;
        $this->numberOfRetries = $numberOfRetries;
        $this->running = true;
    }

    private function isRunning()
    {
        return $this->running;
    }

    private function isInterrupted()
    {
        return !$this->isRunning();
    }

    private function setDefaultRetryValues()
    {
        $this->retriesLeft = $this->numberOfRetries;
        $this->currentBackOffValue = $this->backOffPeriod;
    }

    /**
     * This function will indicate internally that the consumer should stop.
     * When this is checked during execution the consumer will stop.
     */
    public function stopConsuming()
    {
        $this->running = false;
    }

    /**
     * @param callable $handleSSE
     * @param callable $onException
     * @param string[] $messageTypes [optional]
     * @param string[][] $params [optional]
     * @return Generator
     */
    public function consumeUnconfirmed($handleSSE, $onException, $messageTypes = [], $params = [])
    {
        return $this->consume($handleSSE, $onException, ConfirmationStatus::UNCONFIRMED(), -1, null, $messageTypes, $params);
    }

    /**
     * @param callable $handleSSE
     * @param callable $onException
     * @param IOffsetPersister $offsetPersister
     * @param int $offset [optional]
     * @param string[] $messageTypes [optional]
     * @param string[][] $params [optional]
     * @return Generator
     */
    public function consumeUnconfirmedWithOffsetPersistence($handleSSE, $onException, IOffsetPersister $offsetPersister, $offset = -1, $messageTypes = [], $params = [])
    {
        return $this->consume($handleSSE, $onException, ConfirmationStatus::UNCONFIRMED(), $offset, $offsetPersister, $messageTypes, $params);
    }

    /**
     * @param callable $handleSSE
     * @param callable $onException
     * @param IOffsetPersister $offsetPersister
     * @param int $offset [optional]
     * @param string[] $messageTypes [optional]
     * @param string[][] $params [optional]
     * @return Generator|Event[]
     */
    public function consumeAll($handleSSE, $onException, IOffsetPersister $offsetPersister, $offset = -1, $messageTypes = [], $params = [])
    {
        return $this->consume($handleSSE, $onException, ConfirmationStatus::ALL(), $offset, $offsetPersister, $messageTypes, $params);
    }

    /**
     * @param callable $handleSse
     * @param callable $onException
     * @param ConfirmationStatus $confirmationStatus [optional]
     * @param int $initialOffset [optional]
     * @param IOffsetPersister $offsetPersister [optional]
     * @param string[] $messageTypes [optional]
     * @param string[][] $params [optional]
     * @return Generator
     */
    private function consume($handleSse, $onException, ConfirmationStatus $confirmationStatus = null, $initialOffset = -1,
                             IOffsetPersister $offsetPersister = null, $messageTypes = [], $params = [])
    {
        $confirmationStatus = $confirmationStatus ?: ConfirmationStatus::UNCONFIRMED();
        $this->offset = $initialOffset;

        while ($this->isRunning()) {
            try {
                $events = $this->readEvents($confirmationStatus, $messageTypes, $params);
                foreach ($events as $event) {
                    // Connection succeeded and receiving events, reset reconnect values to the default
                    $this->setDefaultRetryValues();

                    $handleSse($event);
                    $id = $event->getId();
                    if ($id && $offsetPersister) {
                        $offsetPersister->setOffset($id);
                    }
                    yield $id;
                    if ($this->isInterrupted()) {
                        break;
                    }
                }
            } catch (Exception $exception) {
                $onException($exception);
            }
            // Consumer lost connection to the event stream, trying a reconnect unless signalled from outside
            // the consumer should stop
            if ($this->isRunning()) {
                $this->backOff($offsetPersister);
            }
        }
    }

    /**
     * @param $confirmationStatus
     * @param $messageTypes
     * @param $params
     * @return Event[]
     */
    private function readEvents($confirmationStatus, $messageTypes, $params)
    {
        $url = $this->createUrl($confirmationStatus, $messageTypes, $params);
        $hmacHeaders = ApiClientUtil::getHmacHeaders('');
        $localPath = parse_url($url, PHP_URL_PATH);
        $requestLine = "GET $localPath HTTP/1.1";
        $hmac = ApiClientUtil::CalculateHttpRequestHmac($this->hmacSecret, $this->consumerName, $hmacHeaders, $requestLine);
        $jwt = ApiClientUtil::createJwt($this->privateKey, $this->consumerName, $this->validPeriodInSeconds);

        $client = new Client($url,
            array_merge($hmacHeaders, array(
                "Authorization" => $hmac,
                "User-Agent" => $this::getFullVersion(),
                'Content-Type' => 'application/json; charset=utf-8',
                "cookie" => "jwt=$jwt; path=$localPath")));
        return $client->getEvents();
    }

    private function backOff(IOffsetPersister $offsetPersister = null)
    {
        if ($this->retriesLeft-- == 0) {
            throw new ConnectException("sse stream disconnected", new GuzzleHttp\Psr7\Request("GET", $this->sseUri));
        }
        $this->offset = $offsetPersister ? $offsetPersister->getOffset() : $this->offset;

        sleep($this->currentBackOffValue);

        if ($this->currentBackOffValue < 60)
            $this->currentBackOffValue *= 2;
    }

    private function createUrl($confirmationStatus, $messageTypes, $params)
    {
        $paramToString = function (array $param) {
            $key = array_shift($param);
            return empty($param) ? "" :  ("&$key=" . implode(",", $param));
        };
        return ($this->sseUri) . "?offset=$this->offset&confirmationStatus=$confirmationStatus" .
            (empty($messageTypes) ? "" : ("&messageTypes=" . implode(",", $messageTypes))) .
            implode(array_map($paramToString, $params));
    }
}


/**
 * @method static self ALL()
 * @method static self UNCONFIRMED()
 */
class ConfirmationStatus extends Enum
{
}

interface IOffsetPersister
{
    function getOffset();

    function setOffset($offset);
}
