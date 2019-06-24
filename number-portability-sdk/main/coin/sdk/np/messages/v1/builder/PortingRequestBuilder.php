<?php


namespace coin\sdk\np\messages\v1\builder;

use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\CustomerInfo;
use coin\sdk\np\messages\v1\Header;
use coin\sdk\np\messages\v1\PortingRequest;
use coin\sdk\np\messages\v1\PortingRequestBody;
use coin\sdk\np\messages\v1\PortingRequestMessage;
use coin\sdk\np\messages\v1\PortingRequestRepeats;

trait PortingRequestSeqBuilder {

    public function createSequence() {

    }
}


class PortingRequestBuilder extends MessageBuilder
{
    use PortingRequestSeqBuilder;

    private $portingrequest;
    private $portingrequestrepeats;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->portingrequest = new PortingRequest();
        $this->header = new Header();
    }

    public static function create() {
        $builder = new self;
        return $builder;
    }

    public function setDossierId($dossierId) {
        $this->portingrequest->setDossierid($dossierId);
        return $this;
    }

    public function setNote($note) {
        $this->portingrequest->setNote($note);
        return $this;
    }

    public function setRecipientnetworkoperator($recipientnetworkoperator) {
        $this->portingrequest->setRecipientnetworkoperator($recipientnetworkoperator);
        return $this;
    }

    public function setRecipientserviceprovider($recipientserviceprovider) {
        $this->portingrequest->setRecipientserviceprovider($recipientserviceprovider);
        return $this;
    }

    public function setDonornetworkoperator($donornetworkoperator) {
        $this->portingrequest->setDonornetworkoperator($donornetworkoperator);
        return $this;
    }

    public function setDonorserviceprovider($donorserviceprovider) {
        $this->portingrequest->setRecipientnetworkoperator($donorserviceprovider);
        return $this;
    }

    public function setCustomerInfo($lastname, $companyname, $housenr, $housenrext, $postcode, $customerid) {
        $customerInfo = new CustomerInfo();
        $customerInfo
            ->setLastName($lastname)
            ->setCompanyname($companyname)
            ->setHousenr($housenr)
            ->setHousenrext($housenrext)
            ->setPostcode($postcode)
            ->setCustomerid($customerid);

        $this->portingrequest->setCustomerinfo($customerInfo);

        return $this;
    }

    public function addPortingRequestSeq($portingRequestSeq) {
        if ($this->portingrequestrepeats == null) {
            $this->portingrequestrepeats = array();
        }
        $this->portingrequestrepeats = array_merge($this->portingrequestrepeats, array(new PortingRequestRepeats(["seq" => $portingRequestSeq])));
        return $this;
    }

    public function build() {
        if (sizeof($this->portingrequestrepeats, 0) > 0) {
            $this->portingrequest->setRepeats($this->portingrequestrepeats);
        }
        $portingRequestMessage = new PortingRequestMessage();
        $portingRequestMessage->setHeader($this->header);
        $portingRequestBody = new PortingRequestBody();
        $portingRequestMessage->setBody($portingRequestBody->setPortingrequest($this->portingrequest));
        return new Message($portingRequestMessage, MessageType::PORTINGREQUEST);
    }
}