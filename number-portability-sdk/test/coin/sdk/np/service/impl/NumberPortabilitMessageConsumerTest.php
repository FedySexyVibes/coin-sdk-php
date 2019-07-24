<?php

use coin\sdk\np\service\impl\INumberPortabilityMessageListener;
use coin\sdk\np\service\impl\NumberPortabilityMessageConsumer;
use PHPUnit\Framework\TestCase;

class NumberPortabilityMessageConsumerTest extends TestCase
{
    public function test()
    {
        $consumer = new NumberPortabilityMessageConsumer();
        $listener = new TestListener();
        $messages = $consumer->getMessages($listener);
        foreach(range(1,20) as $i) {
            $messages->next();
            sleep(0.5);
        }

        $this->assertTrue($listener->activationServiceNumberReceived, "Consumer should handle a ActivationServiceNumber message");
        $this->assertTrue($listener->cancelReceived, "Consumer should handle a Cancel message");
        $this->assertTrue($listener->deactivationReceived, "Consumer should handle a Deactivation message");
        $this->assertTrue($listener->deactivationServiceNumberReceived, "Consumer should handle a DeactivationServiceNumber message");
        $this->assertTrue($listener->enumActivationNumberReceived, "Consumer should handle a EnumActivationNumber message");
        $this->assertTrue($listener->enumActivationOperatorReceived, "Consumer should handle a EnumActivationOperator message");
        $this->assertTrue($listener->enumActivationRangeReceived, "Consumer should handle a EnumActivationRange message");
        $this->assertTrue($listener->enumDeactivationNumberReceived, "Consumer should handle a EnumDeactivationNumber message");
        $this->assertTrue($listener->enumDeactivationOperatorReceived, "Consumer should handle a EnumDeactivationOperator message");
        $this->assertTrue($listener->enumDeactivationRangeReceived, "Consumer should handle a EnumDeactivationRange message");
        $this->assertTrue($listener->enumProfileActivationReceived, "Consumer should handle a EnumProfileActivation message");
        $this->assertTrue($listener->enumProfileDeactivationReceived, "Consumer should handle a EnumProfileDeactivation message");
        $this->assertTrue($listener->errorFoundReceived, "Consumer should handle a ErrorFound message");
        $this->assertTrue($listener->portingPerformedReceived, "Consumer should handle a PortingPerformed message");
        $this->assertTrue($listener->portingRequestReceived, "Consumer should handle a PortingRequest message");
        $this->assertTrue($listener->portingRequestAnswerReceived, "Consumer should handle a PortingRequestAnswer message");
        $this->assertTrue($listener->portingRequestAnswerDelayedReceived, "Consumer should handle a PortingRequestAnswerDelayed message");
        $this->assertTrue($listener->rangeActivationReceived, "Consumer should handle a RangeActivation message");
        $this->assertTrue($listener->rangeDeactivationReceived, "Consumer should handle a RangeDeactivation message");
        $this->assertTrue($listener->tariffChangedServiceNumberReceived, "Consumer should handle a TariffChangedServiceNumber message");
    }
}

class TestListener implements INumberPortabilityMessageListener
{
    public $activationServiceNumberReceived = false;
    public $cancelReceived = false;
    public $deactivationReceived = false;
    public $deactivationServiceNumberReceived = false;
    public $enumActivationNumberReceived = false;
    public $enumActivationOperatorReceived = false;
    public $enumActivationRangeReceived = false;
    public $enumDeactivationNumberReceived = false;
    public $enumDeactivationOperatorReceived = false;
    public $enumDeactivationRangeReceived = false;
    public $enumProfileActivationReceived = false;
    public $enumProfileDeactivationReceived = false;
    public $errorFoundReceived = false;
    public $portingPerformedReceived = false;
    public $portingRequestReceived = false;
    public $portingRequestAnswerReceived = false;
    public $portingRequestAnswerDelayedReceived = false;
    public $rangeDeactivationReceived = false;
    public $rangeActivationReceived = false;
    public $tariffChangedServiceNumberReceived = false;

    function onMessage($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onPortingRequest($messageId, $message)
    {
        $this->portingRequestReceived = true;
    }

    function onPortingRequestAnswer($messageId, $message)
    {
        $this->portingRequestAnswerReceived = true;
    }

    function onPortingRequestAnswerDelayed($messageId, $message)
    {
        $this->portingRequestAnswerDelayedReceived = true;
    }

    function onPortingPerformed($messageId, $message)
    {
        $this->portingPerformedReceived = true;
    }

    function onDeactivation($messageId, $message)
    {
        $this->deactivationReceived = true;
    }

    function onCancel($messageId, $message)
    {
        $this->cancelReceived = true;
    }

    function onErrorFound($messageId, $message)
    {
        $this->errorFoundReceived = true;
    }

    function onActivationServiceNumber($messageId, $message)
    {
        $this->activationServiceNumberReceived = true;
    }

    function onDeactivationServiceNumber($messageId, $message)
    {
        $this->deactivationServiceNumberReceived = true;
    }

    function onTariffChangeServiceNumber($messageId, $message)
    {
        $this->tariffChangedServiceNumberReceived = true;
    }

    function onEnumActivationNumber($messageId, $message)
    {
        $this->enumActivationNumberReceived = true;
    }

    function onEnumActivationOperator($messageId, $message)
    {
        $this->enumActivationOperatorReceived = true;
    }

    function onEnumActivationRange($messageId, $message)
    {
        $this->enumActivationRangeReceived = true;
    }

    function onEnumDeactivationNumber($messageId, $message)
    {
        $this->enumDeactivationNumberReceived = true;
    }

    function onEnumDeactivationOperator($messageId, $message)
    {
        $this->enumDeactivationOperatorReceived = true;
    }

    function onEnumDeactivationRange($messageId, $message)
    {
        $this->enumDeactivationRangeReceived = true;
    }

    function onEnumProfileActivation($messageId, $message)
    {
        $this->enumProfileActivationReceived = true;
    }

    function onEnumProfileDeactivation($messageId, $message)
    {
        $this->enumProfileDeactivationReceived = true;
    }

    function onRangeActivation($messageId, $message)
    {
        $this->rangeActivationReceived = true;
    }

    function onRangeDeactivation($messageId, $message)
    {
        $this->rangeDeactivationReceived = true;
    }
}