<?php

namespace coin\sdk\np\messages\v1\builder;

use coin\sdk\np\messages\v1\ActivationServiceNumber;
use coin\sdk\np\messages\v1\ActivationServiceNumberBody;
use coin\sdk\np\messages\v1\ActivationServiceNumberMessage;
use coin\sdk\np\messages\v1\ActivationServiceNumberRepeats;
use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\NPMessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\Header;

class ActivationServiceNumberBuilder extends NPMessageBuilder
{
    private $activationServiceNumber;
    private $repeats;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->activationServiceNumber = new ActivationServiceNumber();
        $this->header = new Header();
        $this->repeats = array();
    }

    public static function create()
    {
        return new self;
    }

    public function setDossierId($dossierId) {
        $this->activationServiceNumber->setDossierId($dossierId);
        return $this;
    }

    public function setNote($note) {
        $this->activationServiceNumber->setNote($note);
        return $this;
    }

    public function setPlannedDateTime($plannedDateTime) {
        $this->activationServiceNumber->setPlanneddatetime($plannedDateTime);
        return $this;
    }

    public function setPlatformProvider($platformProvider) {
        $this->activationServiceNumber->setPlatformprovider($platformProvider);
        return $this;
    }

    public function addActivationServiceNumberSequence() {
        return new ActivationServiceNumberSequenceBuilder($this);
    }

    public function addRepeatsItem($repeatsItem) {
        array_push($this->repeats, new ActivationServiceNumberRepeats(["seq" => $repeatsItem]));
    }

    public function build() {
        if (count($this->repeats) > 0) {
            $this->activationServiceNumber->setRepeats($this->repeats);
        }

        $activationServiceNumberMessage = new ActivationServiceNumberMessage();
        $activationServiceNumberMessage->setHeader($this->header);
        $activationServiceNumberBody = new ActivationServiceNumberBody();
        $activationServiceNumberMessage->setBody($activationServiceNumberBody->setActivationsn($this->activationServiceNumber));
        return new Message($activationServiceNumberMessage, MessageType::ACTIVATION_SERVICE_NUMBER);
    }
}
