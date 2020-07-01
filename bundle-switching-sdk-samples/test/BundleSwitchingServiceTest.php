<?php

use coin\sdk\bs\messages\v4\builder\ContractTerminationRequestBuilder;
use coin\sdk\bs\service\impl\BundleSwitchingService;
use PHPUnit\Framework\TestCase;

/**
 * @property string provider
 * @property BundleSwitchingService service
 */
class BundleSwitchingServiceSample extends TestCase
{
    private $provider;
    private $donor = "DONOR_NAME";
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
                ->setHeader($this->provider, $this->donor)
                ->setDossierId("$this->provider-$this->donor-$randomId-01")
                ->setRecipientserviceprovider($this->provider)
                ->setDonorserviceprovider($this->donor)
                ->setBusiness("N")
                ->setEarlytermination("N")
                ->setName("name")
                ->setAddress("1234AB", "1")
                ->addNumberSeries("0612345678")
                // ->addValidationBlock("contractid", "sdfj-0j945Aec")
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
