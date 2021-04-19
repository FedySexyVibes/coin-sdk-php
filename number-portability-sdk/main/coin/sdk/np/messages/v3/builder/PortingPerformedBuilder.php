<?php

namespace coin\sdk\np\messages\v3\builder;

use coin\sdk\np\messages\v3\common\Message;
use coin\sdk\np\messages\v3\common\NPMessageBuilder;
use coin\sdk\np\messages\v3\common\MessageType;
use coin\sdk\np\messages\v3\model\Header;
use coin\sdk\np\messages\v3\model\NumberSeries;
use coin\sdk\np\messages\v3\model\PortingPerformed;
use coin\sdk\np\messages\v3\model\PortingPerformedBody;
use coin\sdk\np\messages\v3\model\PortingPerformedMessage;
use coin\sdk\np\messages\v3\model\PortingPerformedRepeats;
use coin\sdk\np\messages\v3\model\PortingPerformedSeq;

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


class PortingPerformedBuilder extends NPMessageBuilder
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

    public static function create()
    {
        return new self;
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
