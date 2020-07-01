<?php

namespace coin\sdk\bs\messages\v4\builder;

use coin\sdk\bs\messages\v4\common\BSMessageBuilder;
use coin\sdk\bs\messages\v4\common\Message;
use coin\sdk\bs\messages\v4\common\MessageType;
use coin\sdk\bs\messages\v4\ContractTerminationPerformed;
use coin\sdk\bs\messages\v4\ContractTerminationPerformedBody;
use coin\sdk\bs\messages\v4\ContractTerminationPerformedMessage;
use coin\sdk\bs\messages\v4\Header;

class ContractTerminationPerformedBuilder extends BSMessageBuilder
{
    private $contractTerminationPerformed;

    public function getThis()
    {
        return $this;
    }

    protected function __construct()
    {
        parent::__construct();
        $this->contractTerminationPerformed = new ContractTerminationPerformed();
        $this->header = new Header();
    }

    public static function create()
    {
        return new self;
    }

    public function setActualDateTime($ActualDateTime)
    {
        $this->contractTerminationPerformed->setActualdatetime($ActualDateTime);
        return $this;
    }

    public function setDossierId($dossierId)
    {
        $this->contractTerminationPerformed->setDossierId($dossierId);
        return $this;
    }

    public function setNote($note)
    {
        $this->contractTerminationPerformed->setNote($note);
        return $this;
    }

    public function build()
    {
        $contractTerminationPerformedMessage = new ContractTerminationPerformedMessage();
        $contractTerminationPerformedMessage->setHeader($this->header);
        $contractTerminationPerformedBody = new ContractTerminationPerformedBody();
        $contractTerminationPerformedMessage->setBody($contractTerminationPerformedBody->setContractTerminationperformed($this->contractTerminationPerformed));
        return new Message($contractTerminationPerformedMessage, MessageType::CONTRACT_TERMINATION_PERFORMED);
    }
}
