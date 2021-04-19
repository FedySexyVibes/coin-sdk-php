<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v3\model;

use coin\sdk\np\messages\v3\builder\PortingRequestAnswerDelayedBuilder;
use coin\sdk\np\messages\v3\ObjectSerializer;

class PortingRequestAnswerDelayedBuilderTest extends SendMessageBaseTest
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = PortingRequestAnswerDelayedBuilder::create();

        $builder
            ->setHeader("TEST01", "TEST02", "TEST01", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setAnswerDueDateTime(date("Ymdhis", time()))
            ->setDonorNetworkOperator("TEST02")
            ->setDonorServiceProvider("TEST02")
            ->setReasonCode("99");

        $portingRequestAnswerDelayed = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $portingRequestAnswerDelayed->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"pradelayed"', $portingRequestAnswerDelayed->__toString(), "Message should contain a body with a pradelayed declaration");

        $response = $this->service->sendMessage($portingRequestAnswerDelayed);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v3\model\MessageResponse');
        $this->assertMatchesRegularExpression('/[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}/i', $messageResponse->getTransactionId(), "A transactionId with the correct pattern should be received");
    }
}
