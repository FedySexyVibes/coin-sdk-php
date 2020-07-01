<?php /** @noinspection PhpParamsInspection */

use coin\sdk\bs\messages\v4\CancelMessage;
use coin\sdk\bs\messages\v4\ContractTerminationPerformedMessage;
use coin\sdk\bs\messages\v4\ContractTerminationRequestAnswerMessage;
use coin\sdk\bs\messages\v4\ContractTerminationRequestMessage;
use coin\sdk\bs\messages\v4\ErrorFoundMessage;
use coin\sdk\bs\service\impl\IBundleSwitchingMessageListener;
use coin\sdk\bs\service\impl\BundleSwitchingMessageConsumer;
use PHPUnit\Framework\TestCase;

class BundleSwitchingMessageConsumerTest extends TestCase
{
    public function test()
    {
        $consumer = new BundleSwitchingMessageConsumer();
        $result = new BSTestResult();
        $listener = new BSTestListener($result, $consumer);
        $generator = $consumer->consumeUnconfirmed($listener);
        foreach(range(1,7) as $i) {
            $generator->next();
        }

        $this->assertTrue($result->cancelReceived, "Consumer should handle a Cancel message");
        $this->assertTrue($result->cancelMessageType, "Message should contain body of type cancel");
        $this->assertTrue($result->errorFoundReceived, "Consumer should handle a ErrorFound message");
        $this->assertTrue($result->errorFoundMessageType, "Message should contain body of type errorfound");
        $this->assertTrue($result->contractTerminationPerformedReceived, "Consumer should handle a ContractTerminationPerformed message");
        $this->assertTrue($result->contractTerminationPerformedMessageType, "Message should contain body of type contractterminationperformed");
        $this->assertTrue($result->contractTerminationRequestReceived, "Consumer should handle a ContractTerminationRequest message");
        $this->assertTrue($result->contractTerminationRequestMessageType, "Message should contain body of type contractterminationrequest");
        $this->assertTrue($result->contractTerminationRequestAnswerReceived, "Consumer should handle a ContractTerminationRequestAnswer message");
        $this->assertTrue($result->contractTerminationRequestAnswerMessageType, "Message should contain body of type contractterminationrequestanswer");
    }
}

/**
 * @property bool cancelMessageType
 * @property bool cancelReceived
 * @property bool contractTerminationPerformedMessageType
 * @property bool contractTerminationPerformedReceived
 * @property bool contractTerminationRequestAnswerMessageType
 * @property bool contractTerminationRequestAnswerReceived
 * @property bool contractTerminationRequestMessageType
 * @property bool contractTerminationRequestReceived
 * @property bool errorFoundMessageType
 * @property bool errorFoundReceived
 */
class BSTestResult {
}

class BSTestListener implements IBundleSwitchingMessageListener
{
    private $result;
    private $consumer;

    public function __construct(BSTestResult $result, BundleSwitchingMessageConsumer $consumer)
    {
        $this->consumer = $consumer;
        $this->result = $result;
    }

    function onContractTerminationRequest($messageId, ContractTerminationRequestMessage $message)
    {
        $this->result->contractTerminationRequestReceived = true;
        $this->result->contractTerminationRequestMessageType = $message->getBody()->getContractTerminationrequest() != null;
    }

    function onContractTerminationRequestAnswer($messageId, ContractTerminationRequestAnswerMessage $message)
    {
        $this->result->contractTerminationRequestAnswerReceived = true;
        $this->result->contractTerminationRequestAnswerMessageType  = $message->getBody()->getContractTerminationrequestanswer() != null;
    }

    function onContractTerminationPerformed($messageId, ContractTerminationPerformedMessage $message)
    {
        $this->result->contractTerminationPerformedReceived = true;
        $this->result->contractTerminationPerformedMessageType = $message->getBody()->getContractTerminationperformed() != null;
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
