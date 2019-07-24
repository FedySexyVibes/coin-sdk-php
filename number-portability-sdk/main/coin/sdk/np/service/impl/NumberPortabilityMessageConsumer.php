<?php

namespace coin\sdk\np\service\impl;

use coin\sdk\common\client\RestApiClient;
use coin\sdk\common\crypto\ApiClientUtil;
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
class NumberPortabilityMessageConsumer extends RestApiClient {

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
     * @param string $consumerName [optional]
     * @param string $privateKeyFile [optional]
     * @param string $encryptedHmacSecretFile [optional]
     * @param string $coinBaseUrl [optional]
     * @param int $backOffPeriod [optional]
     * @param int $numberOfRetries [optional]
     * @param int $validPeriodInSeconds [optional]
     */
    function __construct($consumerName = null, $privateKeyFile = null, $encryptedHmacSecretFile = null, $coinBaseUrl = null,
                         $backOffPeriod = 1, $numberOfRetries = 3, $validPeriodInSeconds = 30) {
        parent::__construct($consumerName, $privateKeyFile, $encryptedHmacSecretFile, $validPeriodInSeconds);
        $this->sseUri = ($coinBaseUrl ?: @$_ENV['COIN_BASE_URL'] ?: $GLOBALS['CoinBaseUrl']).'/number-portability/v1/dossiers/events';
        $this->backOffPeriod = $backOffPeriod;
        $this->numberOfRetries = $numberOfRetries;
    }

    /**
     * @param INumberPortabilityMessageListener $listener
     * @param ConfirmationStatus $confirmationStatus [optional]
     * @param int $initialOffset [optional]
     * @param IOffsetPersister $offsetPersister [optional]
     * @param callable $recoverOffset [optional]
     * @param string ...$messageTypes [optional]
     * @return \Generator
     */
    function getMessages(INumberPortabilityMessageListener $listener, ConfirmationStatus $confirmationStatus = null,
                            $initialOffset = -1, IOffsetPersister $offsetPersister = null, $recoverOffset = null, array $messageTypes = []) {
        $this->confirmationStatus = $confirmationStatus ?: ConfirmationStatus::UNCONFIRMED();
        $this->recoverOffset = $recoverOffset;
        $this->messageTypes = $messageTypes;
        $this->offset = $initialOffset;
        /** @noinspection PhpNonStrictObjectEqualityInspection */
        if ($this->confirmationStatus == ConfirmationStatus::ALL() && $this->offsetPersister == null) {
            throw new BadMethodCallException("offsetPersister should be given when confirmationStatus equals ALL");
        }
        $this->startReading();
        foreach ($this->events as $event) {
            try {
                $data = $event->getData();
                if ($data) {
                    $this->handleMessage($event, $listener);
                    $id = $event->getId();
                    if ($offsetPersister) {
                        $offsetPersister->setOffset($id);
                    }
                    yield $data;
                }
            } catch(Exception $exception) {
                $event->exception = $exception;
                yield $event;
            }
        }
    }

    private function startReading() {
        $url = $this->createUrl();
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

    private function handleMessage($event, INumberPortabilityMessageListener $listener) {
        $type = $event->getEventType();
        $data = $event->getData();
        $object = json_decode($data)->message;
        $id = $event->getId();

        switch ($type) {
            case "activationsn-v1":
                executeOnMessage($event,'ActivationServiceNumberMessage', $listener,'onActivationServiceNumber');
                break;
            case "cancel-v1":
                executeOnMessage($event,'CancelMessage', $listener,'onCancel');
                break;
            case "deactivation-v1":
                executeOnMessage($event,'DeactivationMessage', $listener,'onDeactivation');
                break;
            case "deactivationsn-v1":
                executeOnMessage($event,'DeactivationServiceNumberMessage', $listener,'onDeactivationServiceNumber');
                break;
            case "enumactivationnumber-v1":
                executeOnMessage($event,'EnumActivationNumberMessage', $listener,'onEnumActivationNumber');
                break;
            case "enumactivationoperator-v1":
                executeOnMessage($event,'EnumActivationOperatorMessage', $listener,'onEnumActivationOperator');
                break;
            case "enumactivationrange-v1":
                executeOnMessage($event,'EnumActivationRangeMessage', $listener,'onEnumActivationRange');
                break;
            case "enumdeactivationnumber-v1":
                executeOnMessage($event,'EnumDeactivationNumberMessage', $listener,'onEnumDeactivationNumber');
                break;
            case "enumdeactivationoperator-v1":
                executeOnMessage($event,'EnumDeactivationOperatorMessage', $listener,'onEnumDeactivationOperator');
                break;
            case "enumdeactivationrange-v1":
                executeOnMessage($event,'EnumDeactivationRangeMessage', $listener,'onEnumDeactivationRange');
                break;
            case "enumprofileactivation-v1":
                executeOnMessage($event,'EnumProfileActivationMessage', $listener,'onEnumProfileActivation');
                break;
            case "enumprofiledeactivation-v1":
                executeOnMessage($event,'EnumProfileDeactivationMessage', $listener,'onEnumProfileDeactivation');
                break;
            case "errorfound-v1":
                executeOnMessage($event,'ErrorFoundMessage', $listener,'onErrorFound');
                break;
            case "portingperformed-v1":
                executeOnMessage($event,'PortingPerformedMessage', $listener,'onPortingPerformed');
                break;
            case "portingrequest-v1":
                executeOnMessage($event,'PortingRequestMessage', $listener,'onPortingRequest');
                break;
            case "portingrequestanswer-v1":
                executeOnMessage($event,'PortingRequestAnswerMessage', $listener,'onPortingRequestAnswer');
                break;
            case "pradelayed-v1":
                executeOnMessage($event,'PortingRequestAnswerDelayedMessage', $listener,'onPortingRequestAnswerDelayed');
                break;
            case "rangeactivation-v1":
                executeOnMessage($event,'RangeActivationMessage', $listener,'onRangeActivation');
                break;
            case "rangedeactivation-v1":
                executeOnMessage($event,'RangeDeactivationMessage', $listener,'onRangeDeactivation');
                break;
            case "tariffchangesn-v1":
                executeOnMessage($event,'TariffChangeServiceNumberMessage', $listener,'onTariffChangeServiceNumber');
                break;
            default: throw new UnexpectedValueException("Unknown message type $type");
        }
    }
}

function executeOnMessage($event, $class, $listener, $function) {
    $data = $event->getData();
    $object = json_decode($data)->message;
    $id = $event->getId();
    $message = ObjectSerializer::deserialize($object, "coin\\sdk\\np\messages\\v1\\".$class);
    $listener->$function($id, $message);
}