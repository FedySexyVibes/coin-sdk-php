<?php

namespace coin\sdk\np\service\impl;

use coin\sdk\common\client\CtpApiRestTemplateSupport;
use coin\sdk\np\messages\v1\ConfirmationStatus;
use coin\sdk\np\service\sse\Client;
use GuzzleHttp;
use GuzzleHttp\Exception\ConnectException;

/**
 * @property IOffsetPersister offsetPersister
 * @property INumberPortabilityMessageListener messageListener
 * @method int recoverOffset(int $int)
 */
class NumberPortabilityMessageConsumer extends CtpApiRestTemplateSupport {

    private $consumerName;
    private $sseUri;
    private $backOffPeriod;
    private $numberOfRetries;

    private $retriesLeft;
    private $listener;
    private $confirmationStatus;
    private $messageListener;
    private $offsetPersister;
    private $recoverOffset;
    private $messageTypes;
    private $offset;

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
        $this->consumerName = $consumerName;
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
     */
    function startConsuming(INumberPortabilityMessageListener $listener, ConfirmationStatus $confirmationStatus = null,
                            $initialOffset = -1, IOffsetPersister $offsetPersister = null, $recoverOffset = null, array $messageTypes = []) {
        $this->messageListener = $listener;
        $this->confirmationStatus = $confirmationStatus ?: ConfirmationStatus::UNCONFIRMED();
        $this->offsetPersister = $offsetPersister;
        $this->recoverOffset = $recoverOffset;
        $this->messageTypes = $messageTypes;
        $this->offset = $initialOffset;
        $this->listener = $listener;

        $this->startReading();
    }

    private function startReading() {
        $client = new Client($this->createUrl(), []);
        $this->retriesLeft = $this->numberOfRetries;
        $events = $client->getEvents(function() { $this->onDisconnect(); });
        foreach ($events as $event) {
            $data = $event->getData();
            // TODO: extract id $id and message $message
            // $this->messageListener->onMessage($id, $message);
            $this->retriesLeft = $this->numberOfRetries;
        }
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
