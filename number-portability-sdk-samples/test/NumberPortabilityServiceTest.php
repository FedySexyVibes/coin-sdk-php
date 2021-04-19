<?php

use coin\sdk\np\messages\v3\api\NumberPortabilityService;
use coin\sdk\np\messages\v3\builder\PortingRequestBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @property string operator
 * @property NumberPortabilityService service
 */
class NumberPortabilityServiceSample extends TestCase
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
                ->setHeader($this->operator, 'CRDB', $this->operator)
                ->setTimestamp(date("Ymdhis", time()))
                ->setDossierId("$this->operator-$randomId")
                ->setRecipientnetworkoperator($this->operator)
                ->setContract("EARLY_TERMINATION")
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
