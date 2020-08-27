<?php

use coin\sdk\bs\messages\v4\CancelMessage;
use coin\sdk\bs\messages\v4\ContractTerminationPerformedMessage;
use coin\sdk\bs\messages\v4\ContractTerminationRequestAnswerMessage;
use coin\sdk\bs\messages\v4\ContractTerminationRequestMessage;
use coin\sdk\bs\messages\v4\ErrorFoundMessage;
use coin\sdk\bs\service\impl\BundleSwitchingMessageConsumer;
use coin\sdk\bs\service\impl\BundleSwitchingService;
use coin\sdk\bs\service\impl\IBundleSwitchingMessageListener;
use PHPUnit\Framework\TestCase;

class BundleSwitchingMessageConsumerSample extends TestCase
{
    public function testConsumeMessages()
    {
        $consumer = new BundleSwitchingMessageConsumer();
        $listener = new BSSampleListener();
        $service = new BundleSwitchingService();
        $messageIds = $consumer->consumeUnconfirmed($listener);
        // runs forever (until connection drops and all retries fail)
        foreach($messageIds as $id) {
            $service->sendConfirmation($id);
        }
        // alternatively, consume a single message by calling $messageIds->next().
    }
}

class BSSampleListener implements IBundleSwitchingMessageListener
{
    function onContractTerminationRequest($messageId, ContractTerminationRequestMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onContractTerminationRequestAnswer($messageId, ContractTerminationRequestAnswerMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onContractTerminationPerformed($messageId, ContractTerminationPerformedMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onCancel($messageId, CancelMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onErrorFound($messageId, ErrorFoundMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onKeepAlive()
    {
        echo "\nTestListener received a keepalive message";
    }

    function onException($exception)
    {
        echo "\nTestListener received an exception";
    }

    function onUnknownMessage($messageId, $message)
    {
        echo "\nTestListener received a message with an unknown type with id $messageId";
    }
}
