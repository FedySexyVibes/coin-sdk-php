<?php

use coin\sdk\np\messages\v3\api\NumberPortabilityService;
use coin\sdk\np\messages\v3\builder\PortingPerformedBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @property string operator
 * @property NumberPortabilityService service
 */
class PortingPerformedSampleTest extends TestCase
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

    public function testSendPortingPerformedMessage()
    {
        $randomId = rand(1000, 9999);
        $message = PortingPerformedBuilder::create()
            ->setHeader($this->sender, 'CRDB', $this->sender)
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("$this->sender-$randomId")
            ->setDonorNetworkOperator($this->receiver)
            ->setRecipientNetworkOperator($this->sender)
            ->addPortingPerformedSequence()
            ->setNumberSeries('0303800007', '0303800007')
            ->finish()
            ->build();
        echo "\n\nsending message:\n".$message->__toString();
        $response = $this->service->sendMessage($message);
        echo "\n\nresponse status code: ".$response->getStatusCode();
        echo "\nresponse body: ".$response->getBody();
    }
}
