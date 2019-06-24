<?php

use coin\sdk\np\messages\v1\Header;
use coin\sdk\np\messages\v1\NumberSeries;
use coin\sdk\np\messages\v1\PortingRequest;
use coin\sdk\np\messages\v1\PortingRequestBody;
use coin\sdk\np\messages\v1\PortingRequestMessage;
use coin\sdk\np\messages\v1\PortingRequestRepeats;
use coin\sdk\np\messages\v1\PortingRequestSeq;
use coin\sdk\np\messages\v1\Receiver;
use coin\sdk\np\messages\v1\Sender;
use PHPUnit\Framework\TestCase;

/**
 * @property string operator
 * @property NumberPortabilityService service
 */
class NumberPortabilityServiceTest extends TestCase
{
    private $operator;
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->operator = $GLOBALS['Operator'];
        $this->service = new NumberPortabilityService();
    }


    public function testSendMessage()
    {
        $randomId = rand(1000, 9999);
        $message =
            (new tempMessage())
                ->setHeader((new Header())
                    ->setSender((new Sender())
                        ->setNetworkoperator($this->operator))
                    ->setReceiver((new Receiver())
                        ->setNetworkoperator('CRDB'))
                    ->setTimestamp('20190624090101'))
                ->setBody((new PortingRequestBody())
                    ->setPortingrequest((new PortingRequest())
                        ->setDossierid("$this->operator-$randomId")
                        ->setRecipientnetworkoperator($this->operator)
                        ->setRepeats([
                            (new PortingRequestRepeats())
                                ->setSeq((new PortingRequestSeq())
                                    ->setNumberseries((new NumberSeries())
                                        ->setStart('0612345678')
                                        ->setEnd('0612345678')))
                        ])));
        echo "\n\nsending message:\n".$message->__toString();
        $response = $this->service->sendMessage($message);
        echo "\n\nresponse status code: ".$response->getStatusCode();
        echo "\nresponse body: ".$response->getBody();
    }

    public function testSendConfirmation()
    {
        $randomId = rand(100, 999);
        echo "\n\nsending confirmation with id $randomId";
        $response = $this->service->sendConfirmation($randomId);
        echo "\n\nresponse status code: ".$response->getStatusCode();
        echo "\nresponse body: ".$response->getBody();
    }
}

class tempMessage extends PortingRequestMessage {
    function getMessageType() {
        return 'portingrequest';
    }
}
