<?php

namespace coin\sdk\np\messages\v1\builder;

use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\Header;
use coin\sdk\np\messages\v1\NumberSeries;
use coin\sdk\np\messages\v1\PortingPerformed;
use coin\sdk\np\messages\v1\PortingPerformedBody;
use coin\sdk\np\messages\v1\PortingPerformedMessage;
use coin\sdk\np\messages\v1\PortingPerformedRepeats;
use coin\sdk\np\messages\v1\PortingPerformedSeq;

class PortingPerformedSequenceBuilder {

    private $portingPerformedSequence;
    private $parent;

    public function __construct(PortingPerformedBuilder $parent) {
        $this->parent = $parent;
        $this->portingPerformedSequence = new PortingPerformedSeq();
    }

    public function setNumberSeries($start, $end) {
        $numberSeries = new NumberSeries();
        $numberSeries->setStart($start);
        $numberSeries->setEnd($end);
        $this->portingPerformedSequence->setNumberseries($numberSeries);
        return $this;
    }

    public function setBackPorting($backPorting) {
        $this->portingPerformedSequence->setBackporting($backPorting);
        return $this;
    }

    public function setPop($pop) {
        $this->portingPerformedSequence->setPop($pop);
        return $this;
    }

    public function setProfileIds($profileIds) {
        $enumRepeats = new EnumRepeatsBuilder();
        $enumRepeats->setProfileIds($profileIds);
        $this->portingPerformedSequence->setRepeats($enumRepeats->build());

        return $this;
    }

    public function finish() {
        $this->parent->addRepeatsItem($this->portingPerformedSequence);
        return $this->parent;
    }
}


class PortingPerformedBuilder extends MessageBuilder
{
    private $portingPerformed;
    private $repeats;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->portingPerformed = new PortingPerformed();
        $this->header = new Header();
        $this->repeats = array();
    }

    public function setHeader($sender, $receiver = 'ALLO') {
        return parent::setFullHeader($sender, null, $receiver, null);
    }

    public static function create()
    {
        $builder = new self;
        return $builder;
    }

    public function setActualDateTime($ActualDateTime) {
        $this->portingPerformed->setActualdatetime($ActualDateTime);
        return $this;
    }

    public function setBatchporting($batchPorting) {
        $this->portingPerformed->setBatchporting($batchPorting);
        return $this;
    }

    public function setDonorNetworkOperator($donorNetworkOperator) {
        $this->portingPerformed->setDonornetworkoperator($donorNetworkOperator);
        return $this;
    }

    public function setDossierId($dossierId) {
        $this->portingPerformed->setDossierId($dossierId);
        return $this;
    }

    public function setRecipientNetworkOperator($recipientNetworkOperator) {
        $this->portingPerformed->setRecipientnetworkoperator($recipientNetworkOperator);
        return $this;
    }

    public function addPortingPerformedSequence() {
        return new PortingPerformedSequenceBuilder($this);
    }

    public function addRepeatsItem($repeatsItem) {
        array_push($this->repeats, new PortingPerformedRepeats(["seq" => $repeatsItem]));
    }

    public function build() {
        if (sizeof($this->repeats, 0) > 0) {
            $this->portingPerformed->setRepeats($this->repeats);
        }
        $portingPerformedMessage = new PortingPerformedMessage();
        $portingPerformedMessage->setHeader($this->header);
        $portingPerformedBody = new PortingPerformedBody();
        $portingPerformedMessage->setBody($portingPerformedBody->setPortingperformed($this->portingPerformed));
        return new Message($portingPerformedMessage, MessageType::PORTING_PERFORMED);
    }
}
