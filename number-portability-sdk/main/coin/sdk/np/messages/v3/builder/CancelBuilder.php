<?php

namespace coin\sdk\np\messages\v3\builder;

use coin\sdk\np\messages\v3\model\Cancel;
use coin\sdk\np\messages\v3\model\CancelBody;
use coin\sdk\np\messages\v3\model\CancelMessage;
use coin\sdk\np\messages\v3\common\Message;
use coin\sdk\np\messages\v3\common\NPMessageBuilder;
use coin\sdk\np\messages\v3\common\MessageType;
use coin\sdk\np\messages\v3\model\Header;

class CancelBuilder extends NPMessageBuilder
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
        return new self;
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
