<?php

use coin\sdk\bs\messages\v4\builder\ContractTerminationRequestBuilder;
use coin\sdk\bs\ObjectSerializer;
use coin\sdk\bs\service\impl\BundleSwitchingService;
use PHPUnit\Framework\TestCase;

/**
 * @property string $provider
 * @property BundleSwitchingService service
 */
class BundleSwitchingServiceTest extends TestCase
{
    private $provider;
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->provider = $GLOBALS['Provider'];
        $this->service = new BundleSwitchingService();
    }


    public function testSendMessage()
    {
        $randomId = rand(1000, 9999);
        $message = ContractTerminationRequestBuilder::create()
            ->setHeader($this->provider, 'TST', $this->provider)
            ->setDossierId("$this->provider-TST-$randomId-01")
            ->setRecipientserviceprovider($this->provider)
            ->setDonorserviceprovider('TST')
            ->setBusiness("N")
            ->setEarlytermination("N")
            ->setName("name")
            ->setAddress("1234AB", "1")
            ->build();
        $response = $this->service->sendMessage($message);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\bs\messages\v4\MessageResponse');
        $this->assertNotNull($messageResponse->getTransactionId(), "A transactionId should be received");
    }

    public function testSendConfirmation()
    {
        $randomId = rand(100, 999);
        $response = $this->service->sendConfirmation($randomId);
        $this->assertMatchesRegularExpression('/OK/i', $response->getBody(), "A transactionId with the correct pattern should be received");
    }
}
