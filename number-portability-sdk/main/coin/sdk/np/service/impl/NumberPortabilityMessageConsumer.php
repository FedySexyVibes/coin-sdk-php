<?php

namespace coin\sdk\np\service\impl;

use coin\sdk\common\client\RestApiClient;
use coin\sdk\common\client\sse\Event;
use coin\sdk\common\client\sse\IOffsetPersister;
use coin\sdk\common\client\sse\SseConsumer;
use coin\sdk\np\ObjectSerializer;
use Exception;
use Generator;

/**
 * @property SseConsumer sseConsumer
 */
class NumberPortabilityMessageConsumer extends RestApiClient
{
    private $sseConsumer;

    /**
     * NumberPortabilityMessageConsumer constructor.
     * @param string $consumerName [optional]
     * @param string $privateKeyFile [optional]
     * @param string $encryptedHmacSecretFile [optional]
     * @param string $coinBaseUrl [optional]
     * @param int $backOffPeriod [optional]
     * @param int $numberOfRetries [optional]
     */
    function __construct($consumerName = null, $privateKeyFile = null, $encryptedHmacSecretFile = null, $coinBaseUrl = null,
                         $backOffPeriod = 1, $numberOfRetries = 20)
    {
        parent::__construct($consumerName, $privateKeyFile, $encryptedHmacSecretFile);
        $sseUri = ($coinBaseUrl ?: @$_ENV['COIN_BASE_URL'] ?: $GLOBALS['CoinBaseUrl']) . '/number-portability/v1/dossiers/events';
        $this->sseConsumer = new SseConsumer($sseUri, $consumerName, $privateKeyFile, $encryptedHmacSecretFile, $backOffPeriod, $numberOfRetries);
    }

    /**
     * This function will indicate internally that the consumer should stop.
     * When this is checked during execution the consumer will stop.
     */
    public function stopConsuming()
    {
        ($this->sseConsumer)->stopConsuming();
    }

    /**
     * Recommended method for consuming messages. On connect or reconnect it will consume all unconfirmed messages.
     * @param INumberPortabilityMessageListener $listener
     * @param string ...$messageTypes [optional]
     * @return Generator
     */
    function consumeUnconfirmed(INumberPortabilityMessageListener $listener, ...$messageTypes)
    {
        $handleSse = function (Event $event) use ($listener) {
            $this->handleMessage($event, $listener);
        };
        $onException = function(Exception $exception) use ($listener) {
            $listener->onException($exception);
        };
        return $this->sseConsumer->consumeUnconfirmed($handleSse, $onException, $messageTypes);
    }

    /**
     * Consume all messages, both confirmed and unconfirmed, from a certain offset.
     * Only use for special cases if {@link consumeUnconfirmed} does not meet needs.
     * @param INumberPortabilityMessageListener $listener
     * @param IOffsetPersister $offsetPersister
     * @param int $offset [optional]
     * @param string ...$messageTypes [optional]
     * @return Generator
     */
    function consumeAll(INumberPortabilityMessageListener $listener, IOffsetPersister $offsetPersister,
                               $offset = -1, ...$messageTypes)
    {
        $handleSse = function (Event $event) use ($listener) {
            $this->handleMessage($event, $listener);
        };
        $onException = function(Exception $exception) use ($listener) {
            $listener->onException($exception);
        };
        return $this->sseConsumer->consumeAll($handleSse, $onException, $offsetPersister, $offset, $messageTypes);
    }

    /**
     * Only use this method for receiving unconfirmed messages if you make sure that all messages that are received
     * through this method will be confirmed otherwise, ideally in the stream opened by
     * {@link consumeUnconfirmed}. So this method should only be used for a secondary
     * stream (e.g. backoffice process) that needs to consume unconfirmed messages for administrative purposes.
     * @param INumberPortabilityMessageListener $listener
     * @param IOffsetPersister $offsetPersister
     * @param int $offset [optional]
     * @param string ...$messageTypes [optional]
     * @return Generator
     */
    function consumeUnconfirmedWithOffsetPersistence(INumberPortabilityMessageListener $listener, IOffsetPersister $offsetPersister,
                                                            $offset = -1, ...$messageTypes)
    {
        $handleSse = function (Event $event) use ($listener) {
            $this->handleMessage($event, $listener);
        };
        $onException = function(Exception $exception) use ($listener) {
            $listener->onException($exception);
        };
        return $this->sseConsumer->consumeUnconfirmedWithOffsetPersistence($handleSse, $onException, $offsetPersister, $offset, $messageTypes);
    }

    private function handleMessage(Event $event, INumberPortabilityMessageListener $listener)
    {
        switch ($event->getEventType()) {
            case "activationsn-v1":
                executeOnMessage($event, 'ActivationServiceNumberMessage', $listener, 'onActivationServiceNumber');
                break;
            case "cancel-v1":
                executeOnMessage($event, 'CancelMessage', $listener, 'onCancel');
                break;
            case "deactivation-v1":
                executeOnMessage($event, 'DeactivationMessage', $listener, 'onDeactivation');
                break;
            case "deactivationsn-v1":
                executeOnMessage($event, 'DeactivationServiceNumberMessage', $listener, 'onDeactivationServiceNumber');
                break;
            case "enumactivationnumber-v1":
                executeOnMessage($event, 'EnumActivationNumberMessage', $listener, 'onEnumActivationNumber');
                break;
            case "enumactivationoperator-v1":
                executeOnMessage($event, 'EnumActivationOperatorMessage', $listener, 'onEnumActivationOperator');
                break;
            case "enumactivationrange-v1":
                executeOnMessage($event, 'EnumActivationRangeMessage', $listener, 'onEnumActivationRange');
                break;
            case "enumdeactivationnumber-v1":
                executeOnMessage($event, 'EnumDeactivationNumberMessage', $listener, 'onEnumDeactivationNumber');
                break;
            case "enumdeactivationoperator-v1":
                executeOnMessage($event, 'EnumDeactivationOperatorMessage', $listener, 'onEnumDeactivationOperator');
                break;
            case "enumdeactivationrange-v1":
                executeOnMessage($event, 'EnumDeactivationRangeMessage', $listener, 'onEnumDeactivationRange');
                break;
            case "enumprofileactivation-v1":
                executeOnMessage($event, 'EnumProfileActivationMessage', $listener, 'onEnumProfileActivation');
                break;
            case "enumprofiledeactivation-v1":
                executeOnMessage($event, 'EnumProfileDeactivationMessage', $listener, 'onEnumProfileDeactivation');
                break;
            case "errorfound-v1":
                executeOnMessage($event, 'ErrorFoundMessage', $listener, 'onErrorFound');
                break;
            case "portingperformed-v1":
                executeOnMessage($event, 'PortingPerformedMessage', $listener, 'onPortingPerformed');
                break;
            case "portingrequest-v1":
                executeOnMessage($event, 'PortingRequestMessage', $listener, 'onPortingRequest');
                break;
            case "portingrequestanswer-v1":
                executeOnMessage($event, 'PortingRequestAnswerMessage', $listener, 'onPortingRequestAnswer');
                break;
            case "pradelayed-v1":
                executeOnMessage($event, 'PortingRequestAnswerDelayedMessage', $listener, 'onPortingRequestAnswerDelayed');
                break;
            case "rangeactivation-v1":
                executeOnMessage($event, 'RangeActivationMessage', $listener, 'onRangeActivation');
                break;
            case "rangedeactivation-v1":
                executeOnMessage($event, 'RangeDeactivationMessage', $listener, 'onRangeDeactivation');
                break;
            case "tariffchangesn-v1":
                executeOnMessage($event, 'TariffChangeServiceNumberMessage', $listener, 'onTariffChangeServiceNumber');
                break;
            default:
                if ($event->getData()) {
                    $listener->onUnknownMessage($event->getId(), $event->getData());
                } else {
                    $listener->onKeepAlive();
                }
        }
    }
}

function executeOnMessage($event, $class, $listener, $function)
{
    $data = $event->getData();
    $object = json_decode($data)->message;
    $id = $event->getId();
    $message = ObjectSerializer::deserialize($object, "coin\\sdk\\np\messages\\v1\\" . $class);
    $listener->$function($id, $message);
}

