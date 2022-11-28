<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v3\model;

use coin\sdk\np\messages\v3\builder\EnumDeactivationRangeBuilder;
use coin\sdk\np\messages\v3\ObjectSerializer;

class EnumDeactivationRangeBuilderTest extends SendMessageBaseTest
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = EnumDeactivationRangeBuilder::create();

        $builder
            ->setHeader("TEST01", "TEST02", "TEST01", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setTypeOfNumber("3")
            ->setCurrentNetworkOperator("TEST01")
            ->addEnumNumberSequence()
                ->setNumberSeries("01234567890", "0987654321")
                ->setProfileIds(["PROF1", "PROF2"])
                ->finish();

        $enumdeactivationrange = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $enumdeactivationrange->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"enumdeactivationrange"', $enumdeactivationrange->__toString(), "Message should contain a body with a pradelayed declaration");

        $response = $this->service->sendMessage($enumdeactivationrange);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v3\model\MessageResponse');
        $this->assertNotNull($messageResponse->getTransactionId(), "A transactionId should be received");
    }
}
