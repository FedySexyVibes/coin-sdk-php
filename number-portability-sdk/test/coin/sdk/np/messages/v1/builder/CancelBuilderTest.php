<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v1\builder;

use coin\sdk\np\messages\v1\Cancel;
use coin\sdk\np\messages\v1\CancelBody;
use coin\sdk\np\messages\v1\CancelMessage;
use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\Header;
use coin\sdk\np\messages\v1\Receiver;
use coin\sdk\np\messages\v1\Sender;
use coin\sdk\np\ObjectSerializer;

class CancelBuilderTest extends SendMessageBaseTest
{
    public function testCancelMessageCanBeCreated()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = CancelBuilder::create();
        $builder
            ->setFullHeader("LOADA", "LOADA", "LOADB", "LOADB")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("LOADA-123456")
            ->setNote("Message in notefield");
        $cancel = $builder->build();

        $this->assertEquals(MessageType::CANCEL, $cancel->getMessageType(), "Expected MessageType Cancel");

        $this->assertStringStartsWith("{\"message\"", $cancel->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"cancel"', $cancel->__toString(), "Message should contain a body with a cancel declaration");

        $response = $this->service->sendMessage($cancel);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v1\MessageResponse');
        $this->assertRegExp('/[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}/i', $messageResponse->getTransactionId(), "A transactionId with the correct pattern should be received");
    }

    public function testCancelMessageCanBeCreatedWithArrays()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $cancelMessage = new CancelMessage([
            'header' => new Header([
                'sender' => new Sender([
                    'networkoperator' => 'LOADA',
                    'serviceprovider' => 'LOADA'
                ]),
                'receiver' => new Receiver([
                    'networkoperator' => 'LOADB',
                    'serviceprovider' => 'LOADB'
                ]),
                'timestamp' => date("Ymdhis", time())
            ]),
            'body' => new CancelBody([
                'cancel' => new Cancel([
                    'dossierid' => 'LOADA-123456',
                    'note' => 'Message in notefield'
                ])
            ])
        ]);

        $cancelMessage2 = new Message($cancelMessage, "cancel");

        $this->assertEquals(MessageType::CANCEL, $cancelMessage2->getMessageType(), "Expected MessageType Cancel");
        $this->assertStringStartsWith("{\"message\"", $cancelMessage2->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"cancel"', $cancelMessage2->__toString(), "Message should contain a body with a cancel declaration");
    }
}
