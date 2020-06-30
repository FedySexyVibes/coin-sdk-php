<?php

use coin\sdk\np\service\impl\INumberPortabilityMessageListener;
use coin\sdk\np\service\impl\NumberPortabilityMessageConsumer;
use coin\sdk\np\service\impl\NumberPortabilityService;
use PHPUnit\Framework\TestCase;

class NumberPortabilityMessageConsumerSample extends TestCase
{
    public function testConsumeMessages()
    {
        $consumer = new NumberPortabilityMessageConsumer();
        $listener = new SampleListener();
        // $service = new NumberPortabilityService();
        $consumer->consumeUnconfirmed($listener);
        $messageIds = $consumer->consumeUnconfirmed($listener);
        // runs forever (until connection drops and all retries fail)
        foreach($messageIds as $id) {
            // $service->sendConfirmation($id);
        }
        // alternatively, consume a single message by calling $messageIds->next().
    }
}

class SampleListener implements INumberPortabilityMessageListener
{
    function onPortingRequest($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onPortingRequestAnswer($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onPortingRequestAnswerDelayed($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onPortingPerformed($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onDeactivation($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onCancel($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onErrorFound($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onActivationServiceNumber($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onDeactivationServiceNumber($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onTariffChangeServiceNumber($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumActivationNumber($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumActivationOperator($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumActivationRange($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumDeactivationNumber($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumDeactivationOperator($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumDeactivationRange($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumProfileActivation($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumProfileDeactivation($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onRangeActivation($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onRangeDeactivation($messageId, $message)
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
