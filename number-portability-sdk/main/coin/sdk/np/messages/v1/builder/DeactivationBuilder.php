<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\Deactivation;
use coin\sdk\np\messages\v1\DeactivationBody;
use coin\sdk\np\messages\v1\DeactivationMessage;
use coin\sdk\np\messages\v1\Header;

class DeactivationBuilder extends MessageBuilder
{
    private $deactivation;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->deactivation = new Deactivation();
        $this->header = new Header();
    }

    public static function create()
    {
        $builder = new self;
        return $builder;
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
        $this->deactivation->setDossierId($originalNetworkOperator);
        return $this;
    }

    // TODO Add Repeats

    public function build() {
        $deactivationMessage = new DeactivationMessage();
        $deactivationMessage->setHeader($this->header);
        $deactivationBody = new DeactivationBody();
        $deactivationMessage->setBody($deactivationBody->setDeactivation($this->deactivation));
        return new Message($deactivationMessage, MessageType::DEACTIVATION);
    }
}