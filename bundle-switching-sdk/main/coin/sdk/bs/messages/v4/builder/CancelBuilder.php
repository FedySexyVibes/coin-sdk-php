<?php

namespace coin\sdk\bs\messages\v4\builder;

use coin\sdk\bs\messages\v4\Cancel;
use coin\sdk\bs\messages\v4\CancelBody;
use coin\sdk\bs\messages\v4\CancelMessage;
use coin\sdk\bs\messages\v4\common\BSMessageBuilder;
use coin\sdk\bs\messages\v4\common\Message;
use coin\sdk\bs\messages\v4\common\MessageType;
use coin\sdk\bs\messages\v4\Header;

class CancelBuilder extends BSMessageBuilder
{
    private $cancel;

    public function getThis()
    {
        return $this;
    }

    protected function __construct()
    {
        parent::__construct();
        $this->cancel = new Cancel();
        $this->header = new Header();
    }

    public static function create()
    {
        return new self;
    }

    public function setDossierId($dossierId)
    {
        $this->cancel->setDossierid($dossierId);
        return $this;
    }

    public function setNote($note)
    {
        $this->cancel->setNote($note);
        return $this;
    }

    public function build()
    {
        $cancelMessage = new CancelMessage();
        $cancelMessage->setHeader($this->header);
        $cancelBody = new CancelBody();
        $cancelMessage->setBody($cancelBody->setCancel($this->cancel));
        return new Message($cancelMessage, MessageType::CANCEL);
    }
}
