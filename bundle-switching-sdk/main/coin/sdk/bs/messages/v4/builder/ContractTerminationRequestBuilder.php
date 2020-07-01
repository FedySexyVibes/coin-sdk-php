<?php

namespace coin\sdk\bs\messages\v4\builder;

use coin\sdk\bs\messages\v4\AddressBlock;
use coin\sdk\bs\messages\v4\common\BSMessageBuilder;
use coin\sdk\bs\messages\v4\common\Message;
use coin\sdk\bs\messages\v4\common\MessageType;
use coin\sdk\bs\messages\v4\ContractTerminationRequest;
use coin\sdk\bs\messages\v4\ContractTerminationRequestBody;
use coin\sdk\bs\messages\v4\ContractTerminationRequestMessage;
use coin\sdk\bs\messages\v4\Header;
use coin\sdk\bs\messages\v4\NumberSeries;
use coin\sdk\bs\messages\v4\ValidationBlock;


class ContractTerminationRequestBuilder extends BSMessageBuilder
{
    private $contractTerminationRequest;

    public function getThis()
    {
        return $this;
    }

    protected function __construct()
    {
        parent::__construct();
        $this->contractTerminationRequest = new ContractTerminationRequest();
        $this->header = new Header();
    }

    public static function create()
    {
        return new self;
    }

    public function setDossierId($dossierId)
    {
        $this->contractTerminationRequest->setDossierid($dossierId);
        return $this;
    }

    public function setNote($note)
    {
        $this->contractTerminationRequest->setNote($note);
        return $this;
    }

    public function setRecipientnetworkoperator($recipientnetworkoperator)
    {
        $this->contractTerminationRequest->setRecipientnetworkoperator($recipientnetworkoperator);
        return $this;
    }

    public function setRecipientserviceprovider($recipientserviceprovider)
    {
        $this->contractTerminationRequest->setRecipientserviceprovider($recipientserviceprovider);
        return $this;
    }

    public function setDonornetworkoperator($donornetworkoperator)
    {
        $this->contractTerminationRequest->setDonornetworkoperator($donornetworkoperator);
        return $this;
    }

    public function setDonorserviceprovider($donorserviceprovider)
    {
        $this->contractTerminationRequest->setDonorserviceprovider($donorserviceprovider);
        return $this;
    }

    public function addNumberSeries($start, $end = null)
    {
        $allNumberSeries = $this->contractTerminationRequest->getNumberseries() ?: [];
        $numberSeries = (new NumberSeries())->setStart($start)->setEnd($end);
        array_push($allNumberSeries, $numberSeries);
        $this->contractTerminationRequest->setNumberseries($allNumberSeries);
        return $this;
    }

    public function setBusiness($business)
    {
        $this->contractTerminationRequest->setBusiness($business);
        return $this;
    }

    public function setEarlytermination($earlytermination)
    {
        $this->contractTerminationRequest->setEarlytermination($earlytermination);
        return $this;
    }

    public function setAddress($postcode, $housenr, $housenr_ext = null)
    {
        $this->contractTerminationRequest->setAddressblock(
            (new AddressBlock())->setPostcode($postcode)->setHousenr($housenr)->setHousenrExt($housenr_ext));
        return $this;
    }

    public function setName($name)
    {
        $this->contractTerminationRequest->setName($name);
        return $this;
    }

    public function addValidationBlock($name, $value)
    {
        $ValidationBlocks = $this->contractTerminationRequest->getValidationBlock() ?: [];
        $validationBlock = (new ValidationBlock())->setName($name)->setValue($value);
        array_push($ValidationBlocks, $validationBlock);
        $this->contractTerminationRequest->setValidationBlock($ValidationBlocks);
        return $this;
    }

    public function build()
    {
        $contractTerminationRequestMessage = new ContractTerminationRequestMessage();
        $contractTerminationRequestMessage->setHeader($this->header);
        $contractTerminationRequestBody = new ContractTerminationRequestBody();
        $contractTerminationRequestMessage->setBody($contractTerminationRequestBody->setContractTerminationrequest($this->contractTerminationRequest));
        return new Message($contractTerminationRequestMessage, MessageType::CONTRACT_TERMINATION_REQUEST);
    }
}
