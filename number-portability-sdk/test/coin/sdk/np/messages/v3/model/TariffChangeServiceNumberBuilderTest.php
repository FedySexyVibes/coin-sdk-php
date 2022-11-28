<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v3\model;

use coin\sdk\np\messages\v3\builder\TariffChangeServiceNumberBuilder;
use coin\sdk\np\messages\v3\ObjectSerializer;

class TariffChangeServiceNumberBuilderTest extends SendMessageBaseTest
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');

        $builder = TariffChangeServiceNumberBuilder::create();
        $builder
            ->setHeader("LOADA", "LOADB", "LOADA", "LOADB")
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
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v3\model\MessageResponse');
        $this->assertNotNull($messageResponse->getTransactionId(), "A transactionId should be received");
    }
}
