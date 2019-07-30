<?php /** @noinspection PhpParamsInspection */

use coin\sdk\np\service\impl\INumberPortabilityMessageListener;
use coin\sdk\np\service\impl\NumberPortabilityMessageConsumer;
use PHPUnit\Framework\TestCase;

class NumberPortabilityMessageConsumerTest extends TestCase
{
    public function test()
    {
        $consumer = new NumberPortabilityMessageConsumer();
        $result = new TestResult();
        $listener = new TestListener($result, $consumer);
        $consumer->startConsuming($listener);

        $this->assertTrue($result->activationServiceNumberReceived, "Consumer should handle a ActivationServiceNumber message");
        $this->assertTrue($result->activationServiceNumberMessageType, "Message should contain body of type activationsn");
        $this->assertTrue($result->cancelReceived, "Consumer should handle a Cancel message");
        $this->assertTrue($result->cancelMessageType, "Message should contain body of type cancel");
        $this->assertTrue($result->deactivationReceived, "Consumer should handle a Deactivation message");
        $this->assertTrue($result->deactivationMessageType, "Message should contain body of type deactivation");
        $this->assertTrue($result->deactivationServiceNumberReceived, "Consumer should handle a DeactivationServiceNumber message");
        $this->assertTrue($result->deactivationServiceNumberMessageType, "Message should contain body of type deactivationsn");
        $this->assertTrue($result->enumActivationNumberReceived, "Consumer should handle a EnumActivationNumber message");
        $this->assertTrue($result->enumActivationNumberMessageType, "Message should contain body of type enumactivationnumber");
        $this->assertTrue($result->enumActivationOperatorReceived, "Consumer should handle a EnumActivationOperator message");
        $this->assertTrue($result->enumActivationOperatorMessageType, "Message should contain body of type enumactivationoperator");
        $this->assertTrue($result->enumActivationRangeReceived, "Consumer should handle a EnumActivationRange message");
        $this->assertTrue($result->enumActivationRangeMessageType, "Message should contain body of type enumactivationrange");
        $this->assertTrue($result->enumDeactivationNumberReceived, "Consumer should handle a EnumDeactivationNumber message");
        $this->assertTrue($result->enumDeactivationNumberMessageType, "Message should contain body of type enumdeactivationnumber");
        $this->assertTrue($result->enumDeactivationOperatorReceived, "Consumer should handle a EnumDeactivationOperator message");
        $this->assertTrue($result->enumDeactivationOperatorMessageType, "Message should contain body of type enumdeactivationoperator");
        $this->assertTrue($result->enumDeactivationRangeReceived, "Consumer should handle a EnumDeactivationRange message");
        $this->assertTrue($result->enumDeactivationRangeMessageType, "Message should contain body of type enumdeactivationrange");
        $this->assertTrue($result->enumProfileActivationReceived, "Consumer should handle a EnumProfileActivation message");
        $this->assertTrue($result->enumProfileActivationMessageType, "Message should contain body of type enumprofileactivation");
        $this->assertTrue($result->enumProfileDeactivationReceived, "Consumer should handle a EnumProfileDeactivation message");
        $this->assertTrue($result->enumProfileDeactivationMessageType, "Message should contain body of type enumprofiledeactivation");
        $this->assertTrue($result->errorFoundReceived, "Consumer should handle a ErrorFound message");
        $this->assertTrue($result->errorFoundMessageType, "Message should contain body of type errorfound");
        $this->assertTrue($result->portingPerformedReceived, "Consumer should handle a PortingPerformed message");
        $this->assertTrue($result->portingPerformedMessageType, "Message should contain body of type portingperformed");
        $this->assertTrue($result->portingRequestReceived, "Consumer should handle a PortingRequest message");
        $this->assertTrue($result->portingRequestMessageType, "Message should contain body of type portingrequest");
        $this->assertTrue($result->portingRequestAnswerReceived, "Consumer should handle a PortingRequestAnswer message");
        $this->assertTrue($result->portingRequestAnswerMessageType, "Message should contain body of type portingrequestanswer");
        $this->assertTrue($result->portingRequestAnswerDelayedReceived, "Consumer should handle a PortingRequestAnswerDelayed message");
        $this->assertTrue($result->portingRequestAnswerDelayedMessageType, "Message should contain body of type pradelayed");
        $this->assertTrue($result->rangeActivationReceived, "Consumer should handle a RangeActivation message");
        $this->assertTrue($result->rangeActivationMessageType, "Message should contain body of type rangeactivation");
        $this->assertTrue($result->rangeDeactivationReceived, "Consumer should handle a RangeDeactivation message");
        $this->assertTrue($result->rangeDeactivationMessageType, "Message should contain body of type rangedactivation");
        $this->assertTrue($result->tariffChangeServiceNumberReceived, "Consumer should handle a TariffChangedServiceNumber message");
        $this->assertTrue($result->tariffChangeServiceNumberMessageType, "Message should contain body of type tariffchangesn");
    }
}

/**
 * @property bool activationServiceNumberReceived
 * @property bool activationServiceNumberMessageType
 * @property bool cancelReceived
 * @property bool cancelMessageType
 * @property bool deactivationReceived
 * @property bool deactivationServiceNumberReceived
 * @property bool enumActivationNumberReceived
 * @property bool enumActivationOperatorReceived
 * @property bool enumActivationRangeReceived
 * @property bool enumDeactivationNumberReceived
 * @property bool enumDeactivationOperatorReceived
 * @property bool enumDeactivationRangeReceived
 * @property bool enumProfileActivationReceived
 * @property bool enumProfileDeactivationReceived
 * @property bool errorFoundReceived
 * @property bool portingPerformedReceived
 * @property bool portingRequestReceived
 * @property bool portingRequestAnswerReceived
 * @property bool portingRequestAnswerDelayedReceived
 * @property bool rangeDeactivationReceived
 * @property bool rangeActivationReceived
 * @property bool $tariffChangeServiceNumberReceived
 * @property bool portingRequestAnswerMessageType
 * @property bool portingRequestAnswerDelayedMessageType
 * @property bool portingPerformedMessageType
 * @property bool deactivationMessageType
 * @property bool errorFoundMessageType
 * @property bool deactivationServiceNumberMessageType
 * @property bool tariffChangeServiceNumberMessageType
 * @property bool enumActivationNumberMessageType
 * @property bool enumActivationOperatorMessageType
 * @property bool enumActivationRangeMessageType
 * @property bool enumDeactivationNumberMessageType
 * @property bool enumDeactivationOperatorMessageType
 * @property bool enumDeactivationRangeMessageType
 * @property bool enumProfileActivationMessageType
 * @property bool enumProfileDeactivationMessageType
 * @property bool rangeActivationMessageType
 * @property bool rangeDeactivationMessageType
 * @property bool portingRequestMessageType
 */
class TestResult {
}

class TestListener implements INumberPortabilityMessageListener
{
    private $result;
    private $consumer;
    private $stop = false;

    public function __construct(TestResult $result, NumberPortabilityMessageConsumer $consumer)
    {
        $this->consumer = $consumer;
        $this->result = $result;
    }

    function onPortingRequest($messageId, $message)
    {
        // Make sure we stop when the second porting request is received (all messages are sent
        if ($this->stop) {
            $this->consumer->stopConsuming();
        }
        $this->result->portingRequestReceived = true;
        $this->result->portingRequestMessageType = $message->getBody()->getPortingrequest() != null;

        $this->stop = true;
    }

    function onPortingRequestAnswer($messageId, $message)
    {
        $this->result->portingRequestAnswerReceived = true;
        $this->result->portingRequestAnswerMessageType  = $message->getBody()->getPortingrequestanswer() != null;
    }

    function onPortingRequestAnswerDelayed($messageId, $message)
    {
        $this->result->portingRequestAnswerDelayedReceived = true;
        $this->result->portingRequestAnswerDelayedMessageType = $message->getBody()->getPradelayed() != null;
    }

    function onPortingPerformed($messageId, $message)
    {
        $this->result->portingPerformedReceived = true;
        $this->result->portingPerformedMessageType = $message->getBody()->getPortingperformed() != null;
    }

    function onDeactivation($messageId, $message)
    {
        $this->result->deactivationReceived = true;
        $this->result->deactivationMessageType = $message->getBody()->getDeactivation() != null;
    }

    function onCancel($messageId, $message)
    {
        $this->result->cancelReceived = true;
        $this->result->cancelMessageType = $message->getBody()->getCancel() != null;
    }

    function onErrorFound($messageId, $message)
    {
        $this->result->errorFoundReceived = true;
        $this->result->errorFoundMessageType = $message->getBody()->getErrorFound() != null;
    }

    function onActivationServiceNumber($messageId, $message)
    {
        $this->result->activationServiceNumberReceived = true;
        $this->result->activationServiceNumberMessageType = $message->getBody()->getActivationsn() != null;
    }

    function onDeactivationServiceNumber($messageId, $message)
    {
        $this->result->deactivationServiceNumberReceived = true;
        $this->result->deactivationServiceNumberMessageType = $message->getBody()->getDeactivationsn() != null;
    }

    function onTariffChangeServiceNumber($messageId, $message)
    {
        $this->result->tariffChangeServiceNumberReceived = true;
        $this->result->tariffChangeServiceNumberMessageType = $message->getBody()->getTariffchangesn() != null;
    }

    function onEnumActivationNumber($messageId, $message)
    {
        $this->result->enumActivationNumberReceived = true;
        $this->result->enumActivationNumberMessageType = $message->getBody()->getEnumactivationnumber() != null;
    }

    function onEnumActivationOperator($messageId, $message)
    {
        $this->result->enumActivationOperatorReceived = true;
        $this->result->enumActivationOperatorMessageType = $message->getBody()->getEnumactivationoperator() != null;
    }

    function onEnumActivationRange($messageId, $message)
    {
        $this->result->enumActivationRangeReceived = true;
        $this->result->enumActivationRangeMessageType = $message->getBody()->getEnumactivationrange() != null;
    }

    function onEnumDeactivationNumber($messageId, $message)
    {
        $this->result->enumDeactivationNumberReceived = true;
        $this->result->enumDeactivationNumberMessageType = $message->getBody()->getEnumdeactivationnumber() != null;
    }

    function onEnumDeactivationOperator($messageId, $message)
    {
        $this->result->enumDeactivationOperatorReceived = true;
        $this->result->enumDeactivationOperatorMessageType = $message->getBody()->getEnumdeactivationoperator() != null;
    }

    function onEnumDeactivationRange($messageId, $message)
    {
        $this->result->enumDeactivationRangeReceived = true;
        $this->result->enumDeactivationRangeMessageType = $message->getBody()->getEnumdeactivationrange() != null;
    }

    function onEnumProfileActivation($messageId, $message)
    {
        $this->result->enumProfileActivationReceived = true;
        $this->result->enumProfileActivationMessageType = $message->getBody()->getEnumprofileactivation() != null;
    }

    function onEnumProfileDeactivation($messageId, $message)
    {
        $this->result->enumProfileDeactivationReceived = true;
        $this->result->enumProfileDeactivationMessageType = $message->getBody()->getEnumprofiledeactivation() != null;
    }

    function onRangeActivation($messageId, $message)
    {
        $this->result->rangeActivationReceived = true;
        $this->result->rangeActivationMessageType = $message->getBody()->getRangeactivation() != null;
    }

    function onRangeDeactivation($messageId, $message)
    {
        $this->result->rangeDeactivationReceived = true;
        $this->result->rangeDeactivationMessageType = $message->getBody()->getRangedeactivation() != null;
    }

    function onKeepAlive()
    {
        $this->consumer->stopConsuming();
    }

    function onException($exception)
    {
    }

    function onUnknownMessage($messageId, $message)
    {
    }
}