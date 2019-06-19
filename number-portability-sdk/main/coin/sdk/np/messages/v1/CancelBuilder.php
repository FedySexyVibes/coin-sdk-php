<?php


namespace coin\sdk\np\messages\v1\cancel;

use Message;
use MessageType;
use np\messages\v1\common\Header;
use np\messages\v1\common\MessageBuilder;

class CancelBuilder extends MessageBuilder
{
    private $cancel;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->cancel = new Cancel();
        $this->header = new Header();
    }

    public static function create() {
        $builder = new self;
        return $builder;
    }

    public function setDossierId($dossierId) {
        $this->cancel->setDossierid($dossierId);
        return $this;
    }

    public function setNote($note) {
        $this->cancel->setNote($note);
        return $this;
    }

    public function build() {
        $cancelMessage = new CancelMessage();
        $cancelMessage->setHeader($this->header);
        $cancelBody = new CancelBody();
        $cancelMessage->setBody($cancelBody->setCancel($this->cancel));
        return new Message($cancelMessage, MessageType::CANCEL);
    }
}