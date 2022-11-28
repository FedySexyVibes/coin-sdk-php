<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v3\model;

use coin\sdk\np\messages\v3\builder\ActivationServiceNumberBuilder;
use coin\sdk\np\messages\v3\ObjectSerializer;

class ActivationServiceNumberBuilderTest extends SendMessageBaseTest
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = ActivationServiceNumberBuilder::create();

        $builder
            ->setHeader("TEST01", "TEST02", "TEST01", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setPlannedDateTime(date("Ymdhis", time()))
            ->setNote("TEST02")
            ->setPlatformProvider("TEST02")
            ->addActivationServiceNumberSequence()
                ->setNumberseries("0123456789", "0987654321")
                ->setTariffinfo("2023,50", "1023,50", "0", "2", "1")
                ->setPop("pop")
                ->finish();

        $activationServiceNumber = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $activationServiceNumber->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"activationsn"', $activationServiceNumber->__toString(), "Message should contain a body with a pradelayed declaration");

        $response = $this->service->sendMessage($activationServiceNumber);
        $this->assertEquals(200, $response->getStatusCode(), "Statuscode should equal 200 OK");
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v3\model\MessageResponse');
        $this->assertNotNull($messageResponse->getTransactionId(), "A transactionId should be received");
    }
}
