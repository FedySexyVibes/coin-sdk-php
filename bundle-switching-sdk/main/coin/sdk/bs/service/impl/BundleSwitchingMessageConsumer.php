<?php

namespace coin\sdk\bs\service\impl;

use coin\sdk\common\client\RestApiClient;
use coin\sdk\common\client\sse\Event;
use coin\sdk\common\client\sse\IOffsetPersister;
use coin\sdk\common\client\sse\SseConsumer;
use coin\sdk\bs\ObjectSerializer;
use Exception;
use Generator;

/**
 * @property SseConsumer sseConsumer
 */
class BundleSwitchingMessageConsumer extends RestApiClient
{
    private $sseConsumer;

    /**
     * BundleSwitchingMessageConsumer constructor.
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
        $sseUri = ($coinBaseUrl ?: @$_ENV['COIN_BASE_URL'] ?: $GLOBALS['CoinBaseUrl']) . '/bundle-switching/v4/dossiers/events';
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
     *
     * Only provide serviceProviders if there are multiple service providers linked to your consumer
     * and you only want to consume messages for a subset of these providers.
     * @param IBundleSwitchingMessageListener $listener
     * @param string[] $messageTypes [optional]
     * @param string ...$serviceProviders [optional]
     * @return Generator
     */
    function consumeUnconfirmed(IBundleSwitchingMessageListener $listener, array $messageTypes = [], ...$serviceProviders)
    {
        $handleSse = function (Event $event) use ($listener) {
            $this->handleMessage($event, $listener);
        };
        $onException = function(Exception $exception) use ($listener) {
            $listener->onException($exception);
        };
        return $this->sseConsumer->consumeUnconfirmed($handleSse, $onException, $messageTypes, [array_unshift($serviceProviders, "serviceproviders")]);
    }

    /**
     * Consume all messages, both confirmed and unconfirmed, from a certain offset.
     * Only use for special cases if {@link consumeUnconfirmed} does not meet needs.
     *
     * Only provide serviceProviders if there are multiple service providers linked to your consumer
     * and you only want to consume messages for a subset of these providers.
     * @param IBundleSwitchingMessageListener $listener
     * @param IOffsetPersister $offsetPersister
     * @param int $offset [optional]
     * @param string[] $messageTypes [optional]
     * @param string ...$serviceProviders [optional]
     * @return Generator
     */
    public function consumeAll(IBundleSwitchingMessageListener $listener, IOffsetPersister $offsetPersister, $offset = -1,
                               array $messageTypes = [], ...$serviceProviders)
    {
        $handleSse = function (Event $event) use ($listener) {
            $this->handleMessage($event, $listener);
        };
        $onException = function(Exception $exception) use ($listener) {
            $listener->onException($exception);
        };
        return $this->sseConsumer->consumeAll($handleSse, $onException, $offsetPersister, $offset,
            $messageTypes, [array_unshift($serviceProviders, "serviceproviders")]);
    }

    /**
     * Only use this method for receiving unconfirmed messages if you make sure that all messages that are received
     * through this method will be confirmed otherwise, ideally in the stream opened by
     * {@link consumeUnconfirmed}. So this method should only be used for a secondary
     * stream (e.g. backoffice process) that needs to consume unconfirmed messages for administrative purposes.
     *
     * Only provide serviceProviders if there are multiple service providers linked to your consumer
     * and you only want to consume messages for a subset of these providers.
     * @param IBundleSwitchingMessageListener $listener
     * @param IOffsetPersister $offsetPersister
     * @param int $offset [optional]
     * @param string[] $messageTypes [optional]
     * @param string ...$serviceProviders [optional]
     * @return Generator
     */
    function consumeUnconfirmedWithOffsetPersistence(IBundleSwitchingMessageListener $listener, IOffsetPersister $offsetPersister,
                                                            $offset = -1, array $messageTypes = [], ...$serviceProviders)
    {
        $handleSse = function (Event $event) use ($listener) {
            $this->handleMessage($event, $listener);
        };
        $onException = function(Exception $exception) use ($listener) {
            $listener->onException($exception);
        };
        return $this->sseConsumer->consumeUnconfirmedWithOffsetPersistence($handleSse, $onException, $offsetPersister,
            $offset, $messageTypes, [array_unshift($serviceProviders, "serviceproviders")]);
    }

    private function handleMessage(Event $event, IBundleSwitchingMessageListener $listener)
    {
        $type = $event->getEventType();

        switch ($type) {
            case "cancel-v4":
                executeOnMessage($event, 'CancelMessage', $listener, 'onCancel');
                break;
            case "errorfound-v4":
                executeOnMessage($event, 'ErrorFoundMessage', $listener, 'onErrorFound');
                break;
            case "contractterminationperformed-v4":
                executeOnMessage($event, 'ContractTerminationPerformedMessage', $listener, 'onContractTerminationPerformed');
                break;
            case "contractterminationrequest-v4":
                executeOnMessage($event, 'ContractTerminationRequestMessage', $listener, 'onContractTerminationRequest');
                break;
            case "contractterminationrequestanswer-v4":
                executeOnMessage($event, 'ContractTerminationRequestAnswerMessage', $listener, 'onContractTerminationRequestAnswer');
                break;
            default:
                $listener->onUnknownMessage($event->getId(), $event->getData());
        }
    }
}

function executeOnMessage($event, $class, $listener, $function)
{
    $data = $event->getData();
    $object = json_decode($data)->message;
    $id = $event->getId();
    $message = ObjectSerializer::deserialize($object, "coin\\sdk\\bs\messages\\v4\\" . $class);
    $listener->$function($id, $message);
}

