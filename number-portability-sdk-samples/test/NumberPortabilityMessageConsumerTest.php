<?php

use coin\sdk\np\messages\v1\ActivationServiceNumberMessage;
use coin\sdk\np\messages\v1\CancelMessage;
use coin\sdk\np\messages\v1\DeactivationMessage;
use coin\sdk\np\messages\v1\DeactivationServiceNumberMessage;
use coin\sdk\np\messages\v1\EnumActivationNumberMessage;
use coin\sdk\np\messages\v1\EnumActivationOperatorMessage;
use coin\sdk\np\messages\v1\EnumActivationRangeMessage;
use coin\sdk\np\messages\v1\EnumDeactivationNumberMessage;
use coin\sdk\np\messages\v1\EnumDeactivationOperatorMessage;
use coin\sdk\np\messages\v1\EnumDeactivationRangeMessage;
use coin\sdk\np\messages\v1\EnumProfileActivationMessage;
use coin\sdk\np\messages\v1\EnumProfileDeactivationMessage;
use coin\sdk\np\messages\v1\ErrorFoundMessage;
use coin\sdk\np\messages\v1\PortingPerformedMessage;
use coin\sdk\np\messages\v1\PortingRequestAnswerDelayedMessage;
use coin\sdk\np\messages\v1\PortingRequestAnswerMessage;
use coin\sdk\np\messages\v1\PortingRequestMessage;
use coin\sdk\np\messages\v1\RangeActivationMessage;
use coin\sdk\np\messages\v1\RangeDeactivationMessage;
use coin\sdk\np\messages\v1\TariffChangeServiceNumberMessage;
use coin\sdk\np\service\impl\INumberPortabilityMessageListener;
use coin\sdk\np\service\impl\NumberPortabilityMessageConsumer;
use coin\sdk\np\service\impl\NumberPortabilityService;
use PHPUnit\Framework\TestCase;

class NumberPortabilityMessageConsumerSample extends TestCase
{
    public function testConsumeMessages()
    {
        $consumer = new NumberPortabilityMessageConsumer();
        $listener = new NPSampleListener();
        $service = new NumberPortabilityService();
        $messageIds = $consumer->consumeUnconfirmed($listener);
        // runs forever (until connection drops and all retries fail)
        foreach($messageIds as $id) {
            $service->sendConfirmation($id);
        }
        // alternatively, consume a single message by calling $messageIds->next().
    }
}

class NPSampleListener implements INumberPortabilityMessageListener
{
    function onPortingRequest($messageId, PortingRequestMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onPortingRequestAnswer($messageId, PortingRequestAnswerMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onPortingRequestAnswerDelayed($messageId, PortingRequestAnswerDelayedMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onPortingPerformed($messageId, PortingPerformedMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onDeactivation($messageId, DeactivationMessage $message)
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

    function onActivationServiceNumber($messageId, ActivationServiceNumberMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onDeactivationServiceNumber($messageId, DeactivationServiceNumberMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onTariffChangeServiceNumber($messageId, TariffChangeServiceNumberMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumActivationNumber($messageId, EnumActivationNumberMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumActivationOperator($messageId, EnumActivationOperatorMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumActivationRange($messageId, EnumActivationRangeMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumDeactivationNumber($messageId, EnumDeactivationNumberMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumDeactivationOperator($messageId, EnumDeactivationOperatorMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumDeactivationRange($messageId, EnumDeactivationRangeMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumProfileActivation($messageId, EnumProfileActivationMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumProfileDeactivation($messageId, EnumProfileDeactivationMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onRangeActivation($messageId, RangeActivationMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onRangeDeactivation($messageId, RangeDeactivationMessage $message)
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
