<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\Header;
use coin\sdk\np\messages\v1\PortingRequestAnswer;
use coin\sdk\np\messages\v1\PortingRequestAnswerBody;
use coin\sdk\np\messages\v1\PortingRequestAnswerMessage;

class PortingRequestAnswerBuilder extends MessageBuilder
{
    private $portingRequestAnswer;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->portingRequestAnswer = new PortingRequestAnswer();
        $this->header = new Header();
    }

    public static function create()
    {
        $builder = new self;
        return $builder;
    }

    public function setDossierId($dossierId) {
        $this->portingRequestAnswer->setDossierid($dossierId);
        return $this;
    }

    public function setBlocking($blocking) {
        $this->portingRequestAnswer->setBlocking($blocking);
        return $this;
    }

    // TODO Add repeats

    public function build() {
        $portingRequestAnswerMessage = new PortingRequestAnswerMessage();
        $portingRequestAnswerMessage->setHeader($this->header);
        $portingRequestAnswerBody = new PortingRequestAnswerBody();
        $portingRequestAnswerMessage->setBody($portingRequestAnswerBody->setPortingrequestanswer($this->portingRequestAnswer));
        return new Message($portingRequestAnswerMessage, MessageType::PORTING_REQUEST_ANSWER);
    }
}