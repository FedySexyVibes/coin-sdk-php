<?php

use coin\sdk\np\messages\v1\builder\PortingRequestBuilder;
use coin\sdk\np\service\impl\NumberPortabilityService;
use PHPUnit\Framework\TestCase;

/**
 * @property string operator
 * @property NumberPortabilityService service
 */
class NumberPortabilityServiceTest extends TestCase
{
    private $operator;
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->operator = $GLOBALS['Operator'];
        $this->service = new NumberPortabilityService();
    }


    public function testSendMessage()
    {
        $randomId = rand(1000, 9999);
        $message = PortingRequestBuilder::create()
            ->setHeader($this->operator, 'CRDB')
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("$this->operator-$randomId")
            ->setRecipientnetworkoperator($this->operator)
            ->addPortingRequestSequence()
            ->setNumberSeries('0612345678', '0612345678')
            ->finish()
            ->build();
        echo "\n\nsending message:\n".$message->__toString();
        $response = $this->service->sendMessage($message);
        echo "\n\nresponse status code: ".$response->getStatusCode();
        echo "\nresponse body: ".$response->getBody();
    }

    public function testSendConfirmation()
    {
        $randomId = rand(100, 999);
        echo "\n\nsending confirmation with id $randomId";
        $response = $this->service->sendConfirmation($randomId);
        echo "\n\nresponse status code: ".$response->getStatusCode();
        echo "\nresponse body: ".$response->getBody();
    }
}
