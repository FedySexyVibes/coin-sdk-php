<?php

namespace coin\sdk\np\messages\v3\builder;

use coin\sdk\np\messages\v3\common\Message;
use coin\sdk\np\messages\v3\common\NPMessageBuilder;
use coin\sdk\np\messages\v3\common\MessageType;
use coin\sdk\np\messages\v3\model\Deactivation;
use coin\sdk\np\messages\v3\model\DeactivationBody;
use coin\sdk\np\messages\v3\model\DeactivationMessage;
use coin\sdk\np\messages\v3\model\DeactivationRepeats;
use coin\sdk\np\messages\v3\model\Header;

class DeactivationBuilder extends NPMessageBuilder
{
    private $deactivation;
    private $repeats;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->deactivation = new Deactivation();
        $this->header = new Header();
        $this->repeats = array();
    }

    public static function create()
    {
        return new self;
    }

    public function setCurrentNetworkOperator($currentNetworkOperator) {
        $this->deactivation->setCurrentnetworkoperator($currentNetworkOperator);
        return $this;
    }

    public function setDossierId($dossierId) {
        $this->deactivation->setDossierId($dossierId);
        return $this;
    }

    public function setOriginalNetworkOperator($originalNetworkOperator) {
        $this->deactivation->setOriginalnetworkoperator($originalNetworkOperator);
        return $this;
    }

    public function addDeactivationSequence() {
        return new DeactivationSequenceBuilder($this);
    }

    public function addRepeatsItem($repeatsItem) {
        array_push($this->repeats, new DeactivationRepeats(["seq" => $repeatsItem]));
    }


    public function build() {
        if (count($this->repeats) > 0) {
            $this->deactivation->setRepeats($this->repeats);
        }
        $deactivationMessage = new DeactivationMessage();
        $deactivationMessage->setHeader($this->header);
        $deactivationBody = new DeactivationBody();
        $deactivationMessage->setBody($deactivationBody->setDeactivation($this->deactivation));
        return new Message($deactivationMessage, MessageType::DEACTIVATION);
    }
}
