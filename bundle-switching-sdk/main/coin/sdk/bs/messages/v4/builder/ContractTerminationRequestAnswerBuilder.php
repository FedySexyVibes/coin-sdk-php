<?php

namespace coin\sdk\bs\messages\v4\builder;

use coin\sdk\bs\messages\v4\common\BSMessageBuilder;
use coin\sdk\bs\messages\v4\common\Message;
use coin\sdk\bs\messages\v4\common\MessageType;
use coin\sdk\bs\messages\v4\ContractTerminationRequestAnswer;
use coin\sdk\bs\messages\v4\ContractTerminationRequestAnswerBody;
use coin\sdk\bs\messages\v4\ContractTerminationRequestAnswerMessage;
use coin\sdk\bs\messages\v4\Header;
use coin\sdk\bs\messages\v4\InfraBlock;

class ContractTerminationRequestAnswerBuilder extends BSMessageBuilder
{
    private $contractTerminationRequestAnswer;
    private $repeats;

    public function getThis()
    {
        return $this;
    }

    protected function __construct()
    {
        parent::__construct();
        $this->contractTerminationRequestAnswer = new ContractTerminationRequestAnswer();
        $this->header = new Header();
        $this->repeats = array();
    }

    public static function create()
    {
        return new self;
    }

    public function setDossierId($dossierId)
    {
        $this->contractTerminationRequestAnswer->setDossierid($dossierId);
        return $this;
    }

    public function setBlocking($blocking)
    {
        $this->contractTerminationRequestAnswer->setBlocking($blocking);
        return $this;
    }

    public function setBusiness($business)
    {
        $this->contractTerminationRequestAnswer->setBusiness($business);
        return $this;
    }

    public function setBlockingcode($blockingcode)
    {
        $this->contractTerminationRequestAnswer->setBlockingcode($blockingcode);
        return $this;
    }

    public function setFirstpossibledate($firstpossibledate)
    {
        $this->contractTerminationRequestAnswer->setFirstpossibledate($firstpossibledate);
        return $this;
    }

    public function setNote($note)
    {
        $this->contractTerminationRequestAnswer->setNote($note);
        return $this;
    }

    public function setInfrablock($infraprovider = null, $infratype = null, $infraid = null)
    {
        $this->contractTerminationRequestAnswer->setInfrablock(
            (new InfraBlock())->setInfraprovider($infraprovider)->setInfratype($infratype)->setInfraid($infraid)
        );
        return $this;
    }

    public function build()
    {
        $contractTerminationRequestAnswerMessage = new ContractTerminationRequestAnswerMessage();
        $contractTerminationRequestAnswerMessage->setHeader($this->header);
        $contractTerminationRequestAnswerBody = new ContractTerminationRequestAnswerBody();
        $contractTerminationRequestAnswerMessage->setBody($contractTerminationRequestAnswerBody->setContractTerminationrequestanswer($this->contractTerminationRequestAnswer));
        return new Message($contractTerminationRequestAnswerMessage, MessageType::CONTRACT_TERMINATION_REQUEST_ANSWER);
    }
}
