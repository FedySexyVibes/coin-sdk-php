<?php /** @noinspection PhpParamsInspection */

use coin\sdk\bs\messages\v5\builder\ContractTerminationRequestBuilder;
use coin\sdk\bs\messages\v5\builder\SendMessageBaseTest;
use coin\sdk\bs\ObjectSerializer;

class ContractTerminationRequestBuilderTest extends SendMessageBaseTest
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');

        $builder = ContractTerminationRequestBuilder::create();
        $builder
            ->setHeader("LOADA", "LOADB", "LOADA", "LOADB")
            ->setDossierId("LOADA-LOADB-sfnu94359n-01")
            ->setNote("Just a note!")
            ->setRecipientnetworkoperator("LOADA")
            ->setRecipientserviceprovider("LOADA")
            ->setDonornetworkoperator("LOADB")
            ->setDonorserviceprovider("LOADB")
            ->setEarlytermination("N")
            ->setName("name")
            ->setAddress("1234AB", "1");
        $contractterminationrequest = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $contractterminationrequest->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"contractterminationrequest"', $contractterminationrequest->__toString(), "Message should contain a body with a cancel declaration");

        $response = $this->service->sendMessage($contractterminationrequest);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\bs\messages\v5\MessageResponse');
        $this->assertNotNull($messageResponse->getTransactionId(), "A transactionId should be received");
    }
}
