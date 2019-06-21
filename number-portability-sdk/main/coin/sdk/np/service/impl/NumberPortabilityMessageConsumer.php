<?php

namespace coin\sdk\np\service\impl;

use coin\sdk\common\client\CtpApiRestTemplateSupport;
use coin\sdk\common\crypto\CtpApiClientUtil;
use coin\sdk\np\messages\v1\ConfirmationStatus;
use coin\sdk\np\ObjectSerializer;
use coin\sdk\np\service\sse\Client;
use GuzzleHttp;
use GuzzleHttp\Exception\ConnectException;


/**
 * @property IOffsetPersister offsetPersister
 * @property \coin\sdk\np\service\sse\Event[] events
 * @method int recoverOffset(int $int)
 */
class NumberPortabilityMessageConsumer extends CtpApiRestTemplateSupport {

    private $sseUri;
    private $backOffPeriod;
    private $numberOfRetries;

    private $retriesLeft;
    private $confirmationStatus;
    private $offsetPersister;
    private $recoverOffset;
    private $messageTypes;
    private $offset;

    private $events;

    /**
     * NumberPortabilityMessageConsumer constructor.
     * @param string $consumerName
     * @param string $privateKeyFile
     * @param string $encryptedHmacSecretFile
     * @param string $sseUri
     * @param int $backOffPeriod [optional]
     * @param int $numberOfRetries [optional]
     * @param int $validPeriodInSeconds [optional]
     */
    function __construct($consumerName, $privateKeyFile, $encryptedHmacSecretFile, $sseUri,
                         $backOffPeriod = 1, $numberOfRetries = 3, $validPeriodInSeconds = 30) {
        parent::__construct($consumerName, $privateKeyFile, $encryptedHmacSecretFile, $validPeriodInSeconds);
        $this->sseUri = $sseUri;
        $this->backOffPeriod = $backOffPeriod;
        $this->numberOfRetries = $numberOfRetries;
    }

    /**
     * @param INumberPortabilityMessageListener $listener
     * @param ConfirmationStatus $confirmationStatus
     * @param int $initialOffset
     * @param IOffsetPersister $offsetPersister
     * @param callable $recoverOffset
     * @param string ...$messageTypes
     * @return \Generator
     */
    function getMessages(INumberPortabilityMessageListener $listener, ConfirmationStatus $confirmationStatus = null,
                            $initialOffset = -1, IOffsetPersister $offsetPersister = null, $recoverOffset = null, array $messageTypes = []) {
        $this->confirmationStatus = $confirmationStatus ?: ConfirmationStatus::UNCONFIRMED();
        $this->recoverOffset = $recoverOffset;
        $this->messageTypes = $messageTypes;
        $this->offset = $initialOffset;
        $this->startReading();
        foreach ($this->events as $event) {
            try {
                $data = $event->getData();
                if ($data) {
                    $class = getClassName($event->getEventType());
                    $object = json_decode($data)->message;
                    $message = ObjectSerializer::deserialize($object, $class);
                    $id = $event->getId();
                    $listener->onMessage($id, $message);
                    if ($offsetPersister) {
                        $offsetPersister->setOffset($id);
                    }
                    yield $message;
                }
            } catch(\Exception $exception) {
                $event->exception = $exception;
                yield $event;
            }
        }
    }

    private function startReading() {
        $url = $this->createUrl();
        $hmacHeaders = CtpApiClientUtil::getHmacHeaders('');
        $localPath = parse_url($url, PHP_URL_PATH);
        $requestLine = "GET $localPath HTTP/1.1";
        $hmac = CtpApiClientUtil::CalculateHttpRequestHmac($this->hmacSecret, $this->consumerName, $hmacHeaders, $requestLine);
        $jwt = CtpApiClientUtil::createJwt($this->privateKey, $this->consumerName, $this->validPeriodInSeconds);

        $client = new Client($url,
            array_merge($hmacHeaders, array(
                "Authorization" => $hmac,
                "User-Agent" => "coin-sdk-php-v0.0.0",
                'Content-Type' => 'application/json; charset=utf-8',
                "cookie" => "jwt=$jwt; path=$localPath")));
        $this->retriesLeft = $this->numberOfRetries;
        $this->events = $client->getEvents(function() { $this->onDisconnect(); });
    }

    private function onDisconnect() {
        if ($this->retriesLeft-- == 0) {
            throwException(new ConnectException("sse stream disconnected", new GuzzleHttp\Psr7\Request("GET", $this->sseUri)));
        }
        $persistedOffset = $this->offsetPersister ? $this->offsetPersister->getOffset() : $this->offset;
        $this->offset = $this->recoverOffset ? $this->recoverOffset($persistedOffset) : $persistedOffset;

        sleep($this->backOffPeriod);
        $this->startReading();
    }

    private function createUrl() {
        return ($this->sseUri)."?offset=$this->offset&confirmationStatus=$this->confirmationStatus".
            (empty($messageTypes) ? "" : "messageTypes=".(implode(",", $messageTypes)));
    }
}


function getClassName($type) {
    switch ($type) {
        case "activationsn-v1": return 'coin\sdk\np\messages\v1\ActivationServiceNumberMessage';
        case "cancel-v1": return 'coin\sdk\np\messages\v1\CancelMessage';
        case "deactivation-v1": return 'coin\sdk\np\messages\v1\DeactivationMessage';
        case "deactivationsn-v1": return 'coin\sdk\np\messages\v1\DeactivationServiceNumberMessage';
        case "enumactivationnumber-v1": return 'coin\sdk\np\messages\v1\EnumActivationNumberMessage';
        case "enumactivationoperator-v1": return 'coin\sdk\np\messages\v1\EnumActivationOperatorMessage';
        case "enumactivationrange-v1": return 'coin\sdk\np\messages\v1\EnumActivationRangeMessage';
        case "enumdeactivationnumber-v1": return 'coin\sdk\np\messages\v1\EnumDeactivationNumberMessage';
        case "enumdeactivationoperator-v1": return 'coin\sdk\np\messages\v1\EnumDeactivationOperatorMessage';
        case "enumdeactivationrange-v1": return 'coin\sdk\np\messages\v1\EnumDeactivationRangeMessage';
        case "enumprofileactivation-v1": return 'coin\sdk\np\messages\v1\EnumProfileActivationMessage';
        case "enumprofiledeactivation-v1": return 'coin\sdk\np\messages\v1\EnumProfileDeactivationMessage';
        case "errorfound-v1": return 'coin\sdk\np\messages\v1\ErrorFoundMessage';
        case "portingperformed-v1": return 'coin\sdk\np\messages\v1\PortingPerformedMessage';
        case "portingrequest-v1": return 'coin\sdk\np\messages\v1\PortingRequestMessage';
        case "portingrequestanswer-v1": return 'coin\sdk\np\messages\v1\PortingRequestAnswerMessage';
        case "pradelayed-v1": return 'coin\sdk\np\messages\v1\PortingRequestAnswerDelayedMessage';
        case "rangeactivation-v1": return 'coin\sdk\np\messages\v1\RangeActivationMessage';
        case "rangedeactivation-v1": return 'coin\sdk\np\messages\v1\RangeDeactivationMessage';
        case "tariffchangesn-v1": return 'coin\sdk\np\messages\v1\TariffChangeServiceNumberMessage';
        default: throw new \UnexpectedValueException("Unknown message type $type");
    }
}
