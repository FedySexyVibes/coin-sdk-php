<?php

use coin\sdk\np\messages\v3\api\NumberPortabilityService;
use coin\sdk\np\messages\v3\builder\PortingRequestAnswerBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @property string operator
 * @property NumberPortabilityService service
 */
class PortingRequestAnswerSampleTest extends TestCase
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

    public function testSendPortingRequestAnswerMessage()
    {
        $randomId = rand(1000, 9999);
        $message = PortingRequestAnswerBuilder::create()
            ->setHeader($this->sender, $this->receiver, $this->sender, $this->receiver)
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("$this->sender-$randomId")
            ->setBlocking("N")
            ->addPortingRequestAnswerSequence()
            ->setDonorNetworkOperator($this->sender)
            ->setDonorServiceProvider($this->sender)
            ->setNumberSeries('0303800007', '0303800007')
            ->finish()
            ->build();
        echo "\n\nsending message:\n".$message->__toString();
        $response = $this->service->sendMessage($message);
        echo "\n\nresponse status code: ".$response->getStatusCode();
        echo "\nresponse body: ".$response->getBody();
    }
}
