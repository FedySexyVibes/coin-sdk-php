<?php

use coin\sdk\np\messages\v3\api\NumberPortabilityService;
use coin\sdk\np\messages\v3\builder\PortingRequestAnswerDelayedBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @property string operator
 * @property NumberPortabilityService service
 */
class PortingRequestAnswerDelayedSampleTest extends TestCase
{
    private $sender;
    private $receiver;
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->sender = $GLOBALS['SenderOperator'];
        $this->receiver = $GLOBALS['ReceiverOperator'];
        $this->service = new NumberPortabilityService();
    }

    public function testSendPortingRequestAnswerDelayedMessage()
    {
        $randomId = rand(1000, 9999);
        $message = PortingRequestAnswerDelayedBuilder::create()
            ->setHeader($this->sender, $this->receiver, $this->sender, $this->receiver)
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("$this->sender-$randomId")
            ->setDonorNetworkOperator($this->sender)
            ->setReasonCode("99")
            ->build();
        echo "\n\nsending message:\n".$message->__toString();
        $response = $this->service->sendMessage($message);
        echo "\n\nresponse status code: ".$response->getStatusCode();
        echo "\nresponse body: ".$response->getBody();
    }
}
