<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\DeactivationServiceNumber;
use coin\sdk\np\messages\v1\DeactivationServiceNumberBody;
use coin\sdk\np\messages\v1\DeactivationServiceNumberMessage;
use coin\sdk\np\messages\v1\Header;

class DeactivationServiceNumberBuilder extends MessageBuilder
{
    private $deactivationServiceNumber;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->deactivationServiceNumber = new DeactivationServiceNumber();
        $this->header = new Header();
    }

    public static function create()
    {
        $builder = new self;
        return $builder;
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

    // TODO Add Repeats

    public function build() {
        $deactivationServiceNumberMessage = new DeactivationServiceNumberMessage();
        $deactivationServiceNumberMessage->setHeader($this->header);
        $deactivationServiceNumberBody = new DeactivationServiceNumberBody();
        $deactivationServiceNumberMessage->setBody($deactivationServiceNumberBody->setDeactivationsn($this->deactivationServiceNumber));
        return new Message($deactivationServiceNumberMessage, MessageType::DEACTIVATION);
    }
}