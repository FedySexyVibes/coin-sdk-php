<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\bs\messages\v4\builder;

use coin\sdk\bs\messages\v4\Cancel;
use coin\sdk\bs\messages\v4\CancelBody;
use coin\sdk\bs\messages\v4\CancelMessage;
use coin\sdk\bs\messages\v4\common\Message;
use coin\sdk\bs\messages\v4\common\MessageType;
use coin\sdk\bs\messages\v4\Header;
use coin\sdk\bs\messages\v4\Receiver;
use coin\sdk\bs\messages\v4\Sender;
use coin\sdk\bs\ObjectSerializer;

class CancelBuilderTest extends SendMessageBaseTest
{
    public function testCancelMessageCanBeCreated()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = CancelBuilder::create();
        $builder
            ->setHeader("LOADA", "LOADB", "LOADA", "LOADB")
            ->setDossierId("LOADA-LOADB-123456-01")
            ->setNote("Message in notefield");
        $cancel = $builder->build();

        $this->assertEquals(MessageType::CANCEL, $cancel->getMessageType(), "Expected MessageType Cancel");

        $this->assertStringStartsWith("{\"message\"", $cancel->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"cancel"', $cancel->__toString(), "Message should contain a body with a cancel declaration");

        $response = $this->service->sendMessage($cancel);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\bs\messages\v4\MessageResponse');
        $this->assertNotNull($messageResponse->getTransactionId(), "A transactionId should be received");
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
                    'dossierid' => "LOADA-LOADB-123456-01",
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
