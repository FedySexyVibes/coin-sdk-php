<?php

namespace coin\sdk\np\messages\v1\builder;

use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\CustomerInfo;
use coin\sdk\np\messages\v1\EnumProfileSeq;
use coin\sdk\np\messages\v1\EnumRepeats;
use coin\sdk\np\messages\v1\Header;
use coin\sdk\np\messages\v1\NumberSeries;
use coin\sdk\np\messages\v1\PortingRequest;
use coin\sdk\np\messages\v1\PortingRequestBody;
use coin\sdk\np\messages\v1\PortingRequestMessage;
use coin\sdk\np\messages\v1\PortingRequestRepeats;
use coin\sdk\np\messages\v1\PortingRequestSeq;

class PortingRequestSequenceBuilder {

    private $portingRequestSequence;
    private $parent;

    public function __construct(PortingRequestBuilder $parent) {
        $this->parent = $parent;
        $this->portingRequestSequence = new PortingRequestSeq();
    }

    public function setNumberSeries($start, $end) {
        $numberSeries = new NumberSeries();
        $numberSeries->setStart($start);
        $numberSeries->setEnd($end);
        $this->portingRequestSequence->setNumberseries($numberSeries);
        return $this;
    }

    public function setProfileIds($profileIds) {
        $enumRepeats = new EnumRepeatsBuilder();
        $enumRepeats->setProfileIds($profileIds);
        $this->portingRequestSequence->setRepeats($enumRepeats->build());

        return $this;
    }

    public function finish() {
        $this->parent->addRepeatsItem($this->portingRequestSequence);
        return $this->parent;
    }
}

class PortingRequestBuilder extends MessageBuilder
{
    private $portingrequest;
    private $repeats;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->portingrequest = new PortingRequest();
        $this->header = new Header();
        $this->repeats = array();
    }

    public function setHeader($sender, $receiver = 'CRDB') {
        return parent::setFullHeader($sender, $sender, $receiver, null);
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
        $this->portingrequest->setDonorserviceprovider($donorserviceprovider);
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

    public function addPortingRequestSequence() {
        return new PortingRequestSequenceBuilder($this);
    }

    public function addRepeatsItem($repeatsItem) {
        array_push($this->repeats, new PortingRequestRepeats(["seq" => $repeatsItem]));
    }

    public function build() {
        if (sizeof($this->repeats, 0) > 0) {
            $this->portingrequest->setRepeats($this->repeats);
        }
        $portingRequestMessage = new PortingRequestMessage();
        $portingRequestMessage->setHeader($this->header);
        $portingRequestBody = new PortingRequestBody();
        $portingRequestMessage->setBody($portingRequestBody->setPortingrequest($this->portingrequest));
        return new Message($portingRequestMessage, MessageType::PORTING_REQUEST);
    }
}
