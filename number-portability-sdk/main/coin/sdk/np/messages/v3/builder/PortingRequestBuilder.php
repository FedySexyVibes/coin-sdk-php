<?php

namespace coin\sdk\np\messages\v3\builder;

use coin\sdk\np\messages\v3\common\Message;
use coin\sdk\np\messages\v3\common\NPMessageBuilder;
use coin\sdk\np\messages\v3\common\MessageType;
use coin\sdk\np\messages\v3\model\CustomerInfo;
use coin\sdk\np\messages\v3\model\Header;
use coin\sdk\np\messages\v3\model\NumberSeries;
use coin\sdk\np\messages\v3\model\PortingRequest;
use coin\sdk\np\messages\v3\model\PortingRequestBody;
use coin\sdk\np\messages\v3\model\PortingRequestMessage;
use coin\sdk\np\messages\v3\model\PortingRequestRepeats;
use coin\sdk\np\messages\v3\model\PortingRequestSeq;

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

class PortingRequestBuilder extends NPMessageBuilder
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

    public static function create() {
        return new self;
    }

    public function setDossierId($dossierId) {
        $this->portingrequest->setDossierid($dossierId);
        return $this;
    }

    public function setNote($note) {
        $this->portingrequest->setNote($note);
        return $this;
    }

    public function setContract($contract) {
        $this->portingrequest->setContract($contract);
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
