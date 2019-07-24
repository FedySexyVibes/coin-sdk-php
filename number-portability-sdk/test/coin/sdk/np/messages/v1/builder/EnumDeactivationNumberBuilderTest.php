<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v1\builder;

use coin\sdk\np\ObjectSerializer;

class EnumDeactivationNumberBuilderTest extends SendMessageBaseTest
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = EnumDeactivationNumberBuilder::create();

        $builder
            ->setFullHeader("TEST01", "TEST01", "TEST02", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setTypeOfNumber("Mobile")
            ->setCurrentNetworkOperator("TEST01")
            ->addEnumNumberSequence()
                ->setNumberSeries("01234567890", "0987654321")
                ->setProfileIds(["PROF1", "PROF2"])
                ->finish();

        $enumdeactivationnumber = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $enumdeactivationnumber->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"enumdeactivationnumber"', $enumdeactivationnumber->__toString(), "Message should contain a body with a pradelayed declaration");

        $response = $this->service->sendMessage($enumdeactivationnumber);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v1\MessageResponse');
        $this->assertRegExp('/[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}/i', $messageResponse->getTransactionId(), "A transactionId with the correct pattern should be received");
    }
}
