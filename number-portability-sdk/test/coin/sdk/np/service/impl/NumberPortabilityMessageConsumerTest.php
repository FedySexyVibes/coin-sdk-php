<?php /** @noinspection PhpParamsInspection */

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
use PHPUnit\Framework\TestCase;

class NumberPortabilityMessageConsumerTest extends TestCase
{
    public function test()
    {
        $consumer = new NumberPortabilityMessageConsumer();
        $result = new NPTestResult();
        $listener = new NPTestListener($result, $consumer);
        $generator = $consumer->consumeUnconfirmed($listener);
        foreach(range(1,30) as $i) {
            $generator->next();
        }

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
 * @property bool activationServiceNumberMessageType
 * @property bool activationServiceNumberReceived
 * @property bool cancelMessageType
 * @property bool cancelReceived
 * @property bool deactivationMessageType
 * @property bool deactivationReceived
 * @property bool deactivationServiceNumberMessageType
 * @property bool deactivationServiceNumberReceived
 * @property bool enumActivationNumberMessageType
 * @property bool enumActivationNumberReceived
 * @property bool enumActivationOperatorMessageType
 * @property bool enumActivationOperatorReceived
 * @property bool enumActivationRangeMessageType
 * @property bool enumActivationRangeReceived
 * @property bool enumDeactivationNumberMessageType
 * @property bool enumDeactivationNumberReceived
 * @property bool enumDeactivationOperatorMessageType
 * @property bool enumDeactivationOperatorReceived
 * @property bool enumDeactivationRangeMessageType
 * @property bool enumDeactivationRangeReceived
 * @property bool enumProfileActivationMessageType
 * @property bool enumProfileActivationReceived
 * @property bool enumProfileDeactivationMessageType
 * @property bool enumProfileDeactivationReceived
 * @property bool errorFoundMessageType
 * @property bool errorFoundReceived
 * @property bool portingPerformedMessageType
 * @property bool portingPerformedReceived
 * @property bool portingRequestAnswerDelayedMessageType
 * @property bool portingRequestAnswerDelayedReceived
 * @property bool portingRequestAnswerMessageType
 * @property bool portingRequestAnswerReceived
 * @property bool portingRequestMessageType
 * @property bool portingRequestReceived
 * @property bool rangeActivationMessageType
 * @property bool rangeActivationReceived
 * @property bool rangeDeactivationMessageType
 * @property bool rangeDeactivationReceived
 * @property bool tariffChangeServiceNumberMessageType
 * @property bool tariffChangeServiceNumberReceived
 */
class NPTestResult {
}

class NPTestListener implements INumberPortabilityMessageListener
{
    private $result;
    private $consumer;

    public function __construct(NPTestResult $result, NumberPortabilityMessageConsumer $consumer)
    {
        $this->consumer = $consumer;
        $this->result = $result;
    }

    function onPortingRequest($messageId, PortingRequestMessage $message)
    {
        $this->result->portingRequestReceived = true;
        $this->result->portingRequestMessageType = $message->getBody()->getPortingrequest() != null;
    }

    function onPortingRequestAnswer($messageId, PortingRequestAnswerMessage $message)
    {
        $this->result->portingRequestAnswerReceived = true;
        $this->result->portingRequestAnswerMessageType = $message->getBody()->getPortingrequestanswer() != null;
    }

    function onPortingRequestAnswerDelayed($messageId, PortingRequestAnswerDelayedMessage $message)
    {
        $this->result->portingRequestAnswerDelayedReceived = true;
        $this->result->portingRequestAnswerDelayedMessageType = $message->getBody()->getPradelayed() != null;
    }

    function onPortingPerformed($messageId, PortingPerformedMessage $message)
    {
        $this->result->portingPerformedReceived = true;
        $this->result->portingPerformedMessageType = $message->getBody()->getPortingperformed() != null;
    }

    function onDeactivation($messageId, DeactivationMessage $message)
    {
        $this->result->deactivationReceived = true;
        $this->result->deactivationMessageType = $message->getBody()->getDeactivation() != null;
    }

    function onCancel($messageId, CancelMessage $message)
    {
        $this->result->cancelReceived = true;
        $this->result->cancelMessageType = $message->getBody()->getCancel() != null;
    }

    function onErrorFound($messageId, ErrorFoundMessage $message)
    {
        $this->result->errorFoundReceived = true;
        $this->result->errorFoundMessageType = $message->getBody()->getErrorFound() != null;
    }

    function onActivationServiceNumber($messageId, ActivationServiceNumberMessage $message)
    {
        $this->result->activationServiceNumberReceived = true;
        $this->result->activationServiceNumberMessageType = $message->getBody()->getActivationsn() != null;
    }

    function onDeactivationServiceNumber($messageId, DeactivationServiceNumberMessage $message)
    {
        $this->result->deactivationServiceNumberReceived = true;
        $this->result->deactivationServiceNumberMessageType = $message->getBody()->getDeactivationsn() != null;
    }

    function onTariffChangeServiceNumber($messageId, TariffChangeServiceNumberMessage $message)
    {
        $this->result->tariffChangeServiceNumberReceived = true;
        $this->result->tariffChangeServiceNumberMessageType = $message->getBody()->getTariffchangesn() != null;
    }

    function onEnumActivationNumber($messageId, EnumActivationNumberMessage $message)
    {
        $this->result->enumActivationNumberReceived = true;
        $this->result->enumActivationNumberMessageType = $message->getBody()->getEnumactivationnumber() != null;
    }

    function onEnumActivationOperator($messageId, EnumActivationOperatorMessage $message)
    {
        $this->result->enumActivationOperatorReceived = true;
        $this->result->enumActivationOperatorMessageType = $message->getBody()->getEnumactivationoperator() != null;
    }

    function onEnumActivationRange($messageId, EnumActivationRangeMessage $message)
    {
        $this->result->enumActivationRangeReceived = true;
        $this->result->enumActivationRangeMessageType = $message->getBody()->getEnumactivationrange() != null;
    }

    function onEnumDeactivationNumber($messageId, EnumDeactivationNumberMessage $message)
    {
        $this->result->enumDeactivationNumberReceived = true;
        $this->result->enumDeactivationNumberMessageType = $message->getBody()->getEnumdeactivationnumber() != null;
    }

    function onEnumDeactivationOperator($messageId, EnumDeactivationOperatorMessage $message)
    {
        $this->result->enumDeactivationOperatorReceived = true;
        $this->result->enumDeactivationOperatorMessageType = $message->getBody()->getEnumdeactivationoperator() != null;
    }

    function onEnumDeactivationRange($messageId, EnumDeactivationRangeMessage $message)
    {
        $this->result->enumDeactivationRangeReceived = true;
        $this->result->enumDeactivationRangeMessageType = $message->getBody()->getEnumdeactivationrange() != null;
    }

    function onEnumProfileActivation($messageId, EnumProfileActivationMessage $message)
    {
        $this->result->enumProfileActivationReceived = true;
        $this->result->enumProfileActivationMessageType = $message->getBody()->getEnumprofileactivation() != null;
    }

    function onEnumProfileDeactivation($messageId, EnumProfileDeactivationMessage $message)
    {
        $this->result->enumProfileDeactivationReceived = true;
        $this->result->enumProfileDeactivationMessageType = $message->getBody()->getEnumprofiledeactivation() != null;
    }

    function onRangeActivation($messageId, RangeActivationMessage $message)
    {
        $this->result->rangeActivationReceived = true;
        $this->result->rangeActivationMessageType = $message->getBody()->getRangeactivation() != null;
    }

    function onRangeDeactivation($messageId, RangeDeactivationMessage $message)
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
