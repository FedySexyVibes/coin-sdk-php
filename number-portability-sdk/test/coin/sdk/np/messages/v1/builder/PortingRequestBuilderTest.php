<?php /** @noinspection PhpParamsInspection */

use coin\sdk\np\messages\v1\builder\PortingRequestBuilder;
use coin\sdk\np\messages\v1\builder\SendMessageBaseTest;
use coin\sdk\np\ObjectSerializer;

class PortingRequestBuilderTest extends SendMessageBaseTest
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');

        $builder = PortingRequestBuilder::create();
        $builder
            ->setFullHeader("LOADA", "LOADA", "LOADB", "LOADB")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("123456")
            ->setNote("Just a note!")
            ->setRecipientnetworkoperator("LOADA")
            ->setRecipientserviceprovider("LOADA")
            ->setDonornetworkoperator("LOADB")
            ->setDonorserviceprovider("LOADB")
            ->setCustomerInfo("Test", "Vereniging COIN", "10", "a", "1111AA", "123456")
            ->addPortingRequestSequence()
                ->setNumberSeries("01234567789", "01234567789")
                ->setProfileIds(["PROF1", "PROF2"])
                ->finish()
            ->addPortingRequestSequence()
                ->setNumberSeries("01234567789", "01234567789")
                ->setProfileIds(["PROF1", "PROF2"])
                ->finish();
        $portingrequest = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $portingrequest->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"portingrequest"', $portingrequest->__toString(), "Message should contain a body with a cancel declaration");

        $response = $this->service->sendMessage($portingrequest);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v1\MessageResponse');
        $this->assertRegExp('/[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}/i', $messageResponse->getTransactionId(), "A transactionId with the correct pattern should be received");
    }
}
