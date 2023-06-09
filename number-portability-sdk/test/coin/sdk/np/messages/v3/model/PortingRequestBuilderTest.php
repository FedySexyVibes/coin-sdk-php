<?php /** @noinspection PhpParamsInspection */

use coin\sdk\np\messages\v3\builder\PortingRequestBuilder;
use coin\sdk\np\messages\v3\model\SendMessageBaseTest;
use coin\sdk\np\messages\v3\ObjectSerializer;

class PortingRequestBuilderTest extends SendMessageBaseTest
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');

        $builder = PortingRequestBuilder::create();
        $builder
            ->setHeader("LOADA", "LOADB", "LOADA", "LOADB")
            ->setTimestamp(date("Ymdhis", time()))
            ->setContract("EARLY_TERMINATION")
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
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v3\model\MessageResponse');
        $this->assertNotNull($messageResponse->getTransactionId(), "A transactionId should be received");
    }
}
