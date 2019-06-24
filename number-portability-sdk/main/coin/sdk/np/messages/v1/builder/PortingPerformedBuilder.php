<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\Header;
use coin\sdk\np\messages\v1\PortingPerformed;
use coin\sdk\np\messages\v1\PortingPerformedBody;
use coin\sdk\np\messages\v1\PortingPerformedMessage;

class PortingPerformedBuilder extends MessageBuilder
{
    private $portingPerformed;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->portingPerformed = new PortingPerformed();
        $this->header = new Header();
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

    // TODO Add repeats

    public function build() {
        $portingPerformedMessage = new PortingPerformedMessage();
        $portingPerformedMessage->setHeader($this->header);
        $portingPerformedBody = new PortingPerformedBody();
        $portingPerformedMessage->setBody($portingPerformedBody->setPortingperformed($this->portingPerformed));
        return new Message($portingPerformedMessage, MessageType::PORTING_PERFORMED);
    }
}