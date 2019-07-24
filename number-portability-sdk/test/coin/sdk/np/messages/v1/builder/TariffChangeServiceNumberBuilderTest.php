<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v1\builder;

use coin\sdk\np\ObjectSerializer;

class TariffChangeServiceNumberBuilderTest extends SendMessageBaseTest
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');

        $builder = TariffChangeServiceNumberBuilder::create();
        $builder
            ->setFullHeader("LOADA", "LOADA", "LOADB", "LOADB")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("123456")
            ->setPlatformProvider("TEST01")
            ->setPlannedDateTime(date("Ymdhis", time()))
            ->addTariffChangeServiceNumberSequence()
                ->setNumberSeries("0123456789", "0987654321")
                ->setTariffInfoNew("2023,50", "1023,50", "0", "2", "1")
                ->finish();

        $tariffchangesn = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $tariffchangesn->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"tariffchangesn"', $tariffchangesn->__toString(), "Message should contain a body with a cancel declaration");

        $response = $this->service->sendMessage($tariffchangesn);
        $this->assertEquals(200, $response->getStatusCode(), "Statuscode should equal 200 OK");
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v1\MessageResponse');
        $this->assertRegExp('/[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}/i', $messageResponse->getTransactionId(), "A transactionId with the correct pattern should be received");
    }
}
