<?php

use coin\sdk\np\service\impl\INumberPortabilityMessageListener;
use coin\sdk\np\service\impl\NumberPortabilityMessageConsumer;
use PHPUnit\Framework\TestCase;

class NumberPortabilityMessageConsumerSample extends TestCase
{
    public function testConsumeMessages()
    {
        $consumer = new NumberPortabilityMessageConsumer();
        $listener = new SampleListener();
        $messages = $consumer->getMessages($listener);
        foreach(range(1,20) as $i) {
            echo "\n".$messages->current();
            $messages->next();
            sleep(1);
        }
    }
}

class SampleListener implements INumberPortabilityMessageListener
{
    function onMessage($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

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
}
