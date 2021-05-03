<?php

use coin\sdk\np\messages\v3\api\NumberPortabilityService;
use coin\sdk\np\messages\v3\builder\PortingRequestBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @property string operator
 * @property NumberPortabilityService service
 */
class PortingRequestSampleTest extends TestCase
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

    public function testSendPortingRequestMessage()
    {
        $randomId = rand(1000, 9999);
        $message = PortingRequestBuilder::create()
                ->setHeader($this->sender, 'CRDB', $this->sender)
                ->setTimestamp(date("Ymdhis", time()))
                ->setDossierId("$this->sender-$randomId")
                ->setRecipientnetworkoperator($this->sender)
                ->setCustomerInfo(NULL, "COIN", "10", NULL, "2803PK", "1234")
                ->setNote("some additional information")
                ->setContract("EARLY_TERMINATION")
                ->addPortingRequestSequence()
                    ->setNumberSeries('0303800007', '0303800007')
                    ->finish()
                ->build();
        echo "\n\nsending message:\n".$message->__toString();
        $response = $this->service->sendMessage($message);
        echo "\n\nresponse status code: ".$response->getStatusCode();
        echo "\nresponse body: ".$response->getBody();
    }
}
