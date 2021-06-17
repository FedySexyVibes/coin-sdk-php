<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v3\model;

use coin\sdk\np\messages\v3\builder\DeactivationBuilder;
use coin\sdk\np\messages\v3\ObjectSerializer;

class DeactivationBuilderTest extends SendMessageBaseTest
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = DeactivationBuilder::create();

        $builder
            ->setHeader("TEST01", "TEST02", "TEST01", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setCurrentNetworkOperator("TEST02")
            ->setOriginalNetworkOperator("TEST01")
            ->addDeactivationSequence()
                ->setNumberSeries("0123456789", "0987654321")
                ->finish();

        $deactivation = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $deactivation->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"deactivation"', $deactivation->__toString(), "Message should contain a body with a pradelayed declaration");

        $response = $this->service->sendMessage($deactivation);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v3\model\MessageResponse');
        $this->assertMatchesRegularExpression('/[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}/i', $messageResponse->getTransactionId(), "A transactionId with the correct pattern should be received");
    }
}
