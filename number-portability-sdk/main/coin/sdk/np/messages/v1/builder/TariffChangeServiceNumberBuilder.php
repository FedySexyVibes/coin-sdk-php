<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\ActivationServiceNumberRepeats;
use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\Header;
use coin\sdk\np\messages\v1\TariffChangeServiceNumber;
use coin\sdk\np\messages\v1\TariffChangeServiceNumberBody;
use coin\sdk\np\messages\v1\TariffChangeServiceNumberMessage;

class TariffChangeServiceNumberBuilder extends MessageBuilder
{
    private $tariffChangeServiceNumber;
    private $repeats;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->tariffChangeServiceNumber = new TariffChangeServiceNumber();
        $this->header = new Header();
        $this->repeats = array();
    }

    public static function create()
    {
        $builder = new self;
        return $builder;
    }

    public function setDossierId($dossierId) {
        $this->tariffChangeServiceNumber->setDossierid($dossierId);
        return $this;
    }

    public function setPlatformProvider($platformProvider) {
        $this->tariffChangeServiceNumber->setPlatformprovider($platformProvider);
        return $this;
    }

    public function setPlannedDateTime($plannedDateTime) {
        $this->tariffChangeServiceNumber->setPlanneddatetime($plannedDateTime);
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
            $this->tariffChangeServiceNumber->setRepeats($this->repeats);
        }

        $tariffChangeServiceNumberMessage = new TariffChangeServiceNumberMessage();
        $tariffChangeServiceNumberMessage->setHeader($this->header);
        $tariffChangeServiceNumberBody = new TariffChangeServiceNumberBody();
        $tariffChangeServiceNumberMessage->setBody($tariffChangeServiceNumberBody->setTariffchangesn($this->tariffChangeServiceNumber));
        return new Message($tariffChangeServiceNumberMessage, MessageType::TARIFF_CHANGE_SERVICE_NUMNER);
    }
}