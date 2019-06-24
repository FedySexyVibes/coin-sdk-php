<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\ActivationServiceNumber;
use coin\sdk\np\messages\v1\ActivationServiceNumberBody;
use coin\sdk\np\messages\v1\ActivationServiceNumberMessage;
use coin\sdk\np\messages\v1\ActivationServiceNumberRepeats;
use coin\sdk\np\messages\v1\ActivationServiceNumberSeq;
use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\Header;
use coin\sdk\np\messages\v1\NumberSeries;
use coin\sdk\np\messages\v1\TariffInfo;
use function PHPSTORM_META\argumentsSet;

class ActivationServiceNumberSequenceBuilder {

    private $activationServiceNumberSequence;
    private $parent;

    public function __construct($parent) {
        $this->parent = $parent;
        $this->activationServiceNumberSequence = new ActivationServiceNumberSeq();
    }

    public function setNumberSeries($start, $end) {
        $numberSeries = new NumberSeries();
        $numberSeries->setStart($start);
        $numberSeries->setEnd($end);
        $this->activationServiceNumberSequence->setNumberseries($numberSeries);
        return $this;
    }

    public function setTariffInfo($peak, $offPeak, $currency, $type, $vat) {
        $tariffInfo = new TariffInfo();
        $tariffInfo->setPeak($peak);
        $tariffInfo->setOffpeak($offPeak);
        $tariffInfo->setCurrency($currency);
        $tariffInfo->setType($type);
        $tariffInfo->setVat($vat);
        $this->activationServiceNumberSequence->setTariffinfo($tariffInfo);
        return $this;
    }

    public function setPop($pop) {
        $this->activationServiceNumberSequence->setPop($pop);
        return $this;
    }

    public function finish() {
        $this->parent->addRepeatsItem($this->activationServiceNumberSequence);
        return $this->parent;
    }
}

class ActivationServiceNumberBuilder extends MessageBuilder
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
        $builder = new self;
        return $builder;
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

    // TODO Add Repeats
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