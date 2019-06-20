<?php

namespace coin\sdk\np\service\impl;

use coin\sdk\common\client\CtpApiRestTemplateSupport;
use function coin\sdk\np\messages\v1\common\deserialize;
use coin\sdk\np\messages\v1\ConfirmationStatus;
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
                $rawMessage = json_decode($event->getData(), true)->message;
                $message = deserialize($event->getEventType(), $rawMessage)->getMessage();
                $id = $event->getId();
                $listener->onMessage($id, $message);
                if ($offsetPersister) {
                    $offsetPersister->setOffset($id);
                }
                yield $message;
            } catch(\Exception $exception) {
                $event->exception = $exception;
                yield $event;
            }
        }
    }

    private function startReading() {
        $client = new Client($this->createUrl(), []);
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
