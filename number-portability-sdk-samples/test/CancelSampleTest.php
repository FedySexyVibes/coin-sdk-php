<?php

use coin\sdk\np\messages\v3\api\NumberPortabilityService;
use coin\sdk\np\messages\v3\builder\CancelBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @property string operator
 * @property NumberPortabilityService service
 */
class CancelSampleTest extends TestCase
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

    public function testSendCancelMessage()
    {
        $randomId = rand(1000, 9999);
        $message = CancelBuilder::create()
            ->setHeader($this->sender, $this->receiver, $this->sender)
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("$this->sender-$randomId")
            ->setNote("some additional information")
            ->build();
        echo "\n\nsending message:\n".$message->__toString();
        $response = $this->service->sendMessage($message);
        echo "\n\nresponse status code: ".$response->getStatusCode();
        echo "\nresponse body: ".$response->getBody();
    }
}
