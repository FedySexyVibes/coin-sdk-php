<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\ActivationServiceNumberRepeats;
use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\DeactivationServiceNumberRepeats;
use coin\sdk\np\messages\v1\Header;
use coin\sdk\np\messages\v1\RangeContent;
use coin\sdk\np\messages\v1\RangeDeactivationBody;
use coin\sdk\np\messages\v1\RangeDeactivationMessage;

class RangeDeactivationBuilder extends MessageBuilder
{
    private $rangeContent;
    private $repeats;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->rangeContent = new RangeContent();
        $this->header = new Header();
        $this->repeats = array();
    }

    public static function create()
    {
        $builder = new self;
        return $builder;
    }

    public function setDossierId($dossierId) {
        $this->rangeContent->setDossierid($dossierId);
        return $this;
    }

    public function setPlannedDateTime($plannedDateTime) {
        $this->rangeContent->setPlanneddatetime($plannedDateTime);
        return $this;
    }

    public function setCurrentNetworkOperator($currentNetworkOperator) {
        $this->rangeContent->setCurrentnetworkoperator($currentNetworkOperator);
        return $this;
    }

    public function setOptaNr($optaNr) {
        $this->rangeContent->setOptanr($optaNr);
        return $this;
    }

    public function addDeactivationServiceNumberSequence() {
        return new DeactivationServiceNumberSequenceBuilder($this);
    }

    public function addRepeatsItem($repeatsItem) {
        array_push($this->repeats, new DeactivationServiceNumberRepeats(["seq" => $repeatsItem]));
    }


    public function build()
    {
        if (count($this->repeats) > 0) {
            $this->rangeContent->setRepeats($this->repeats);
        }

        $rangeDeactivationMessage = new RangeDeactivationMessage();
        $rangeDeactivationMessage->setHeader($this->header);
        $rangeDeactivationBody = new RangeDeactivationBody();
        $rangeDeactivationMessage->setBody($rangeDeactivationBody->setRangeDeactivation($this->rangeContent));
        return new Message($rangeDeactivationMessage, MessageType::RANGE_DEACTIVATION);
    }
}