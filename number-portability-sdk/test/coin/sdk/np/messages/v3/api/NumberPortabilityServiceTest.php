<?php

namespace coin\sdk\np\messages\v3\api;

use coin\sdk\np\messages\v3\builder\PortingRequestBuilder;
use coin\sdk\np\messages\v3\ObjectSerializer;
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
            ->setHeader($this->operator, 'CRDB', $this->operator)
            ->setContract("EARLY_TERMINATION")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("$this->operator-$randomId")
            ->setRecipientnetworkoperator($this->operator)
            ->addPortingRequestSequence()
            ->setNumberSeries('0612345678', '0612345678')
            ->finish()
            ->build();
        $response = $this->service->sendMessage($message);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v3\model\MessageResponse');
        $this->assertNotNull($messageResponse->getTransactionId(), "A transactionId should be received");
    }

    public function testSendConfirmation()
    {
        $randomId = rand(100, 999);
        $response = $this->service->sendConfirmation($randomId);
        $this->assertMatchesRegularExpression('/OK/i', $response->getBody(), "A transactionId with the correct pattern should be received");
    }
}
