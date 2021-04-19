<?php

namespace coin\sdk\np\messages\v3\builder;

use coin\sdk\np\messages\v3\common\Message;
use coin\sdk\np\messages\v3\common\NPMessageBuilder;
use coin\sdk\np\messages\v3\common\MessageType;
use coin\sdk\np\messages\v3\model\DeactivationServiceNumber;
use coin\sdk\np\messages\v3\model\DeactivationServiceNumberBody;
use coin\sdk\np\messages\v3\model\DeactivationServiceNumberMessage;
use coin\sdk\np\messages\v3\model\DeactivationServiceNumberRepeats;
use coin\sdk\np\messages\v3\model\Header;

class DeactivationServiceNumberBuilder extends NPMessageBuilder
{
    private $deactivationServiceNumber;
    private $repeats;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->deactivationServiceNumber = new DeactivationServiceNumber();
        $this->header = new Header();
        $this->repeats = array();
    }

    public static function create()
    {
        return new self;
    }

    public function setDossierId($dossierId) {
        $this->deactivationServiceNumber->setDossierId($dossierId);
        return $this;
    }

    public function setPlannedDateTime($plannedDateTime) {
        $this->deactivationServiceNumber->setPlanneddatetime($plannedDateTime);
        return $this;
    }

    public function setPlatformProvider($platformProvider) {
        $this->deactivationServiceNumber->setPlatformprovider($platformProvider);
        return $this;
    }

    public function addDeactivationServiceNumberSequence() {
        return new DeactivationServiceNumberSequenceBuilder($this);
    }

    public function addRepeatsItem($repeatsItem) {
        array_push($this->repeats, new DeactivationServiceNumberRepeats(["seq" => $repeatsItem]));
    }

    public function build() {
        if (count($this->repeats) > 0) {
            $this->deactivationServiceNumber->setRepeats($this->repeats);
        }
        $deactivationServiceNumberMessage = new DeactivationServiceNumberMessage();
        $deactivationServiceNumberMessage->setHeader($this->header);
        $deactivationServiceNumberBody = new DeactivationServiceNumberBody();
        $deactivationServiceNumberMessage->setBody($deactivationServiceNumberBody->setDeactivationsn($this->deactivationServiceNumber));
        return new Message($deactivationServiceNumberMessage, MessageType::DEACTIVATION_SERVICE_NUMBER);
    }
}
