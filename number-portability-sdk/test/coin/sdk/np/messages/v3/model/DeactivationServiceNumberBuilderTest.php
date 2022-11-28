<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v3\model;

use coin\sdk\np\messages\v3\builder\DeactivationServiceNumberBuilder;
use coin\sdk\np\messages\v3\ObjectSerializer;

class DeactivationServiceNumberBuilderTest extends SendMessageBaseTest
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = DeactivationServiceNumberBuilder::create();

        $builder
            ->setHeader("TEST01", "TEST02", "TEST01", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setPlannedDateTime(date("Ymdhis", time()))
            ->setPlatformProvider("TEST02")
            ->addDeactivationServiceNumberSequence()
                ->setNumberseries("0123456789", "0987654321")
                ->setPop("pop")
                ->finish();

        $deactivationServiceNumber = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $deactivationServiceNumber->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"deactivationsn"', $deactivationServiceNumber->__toString(), "Message should contain a body with a pradelayed declaration");

        $response = $this->service->sendMessage($deactivationServiceNumber);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v3\model\MessageResponse');
        $this->assertNotNull($messageResponse->getTransactionId(), "A transactionId should be received");
    }
}
