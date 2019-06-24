<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\Header;
use coin\sdk\np\messages\v1\PortingRequestAnswerDelayed;
use coin\sdk\np\messages\v1\PortingRequestAnswerDelayedBody;
use coin\sdk\np\messages\v1\PortingRequestAnswerDelayedMessage;
use coin\sdk\np\messages\v1\RangeContent;

class PortingRequestAnswerDelayedBuilder extends MessageBuilder
{
    private $portingRequestAnswerDelayed;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->portingRequestAnswerDelayed = new PortingRequestAnswerDelayed();
        $this->header = new Header();
    }

    public static function create()
    {
        $builder = new self;
        return $builder;
    }

    public function setAnswerDueDateTime($answerDueDateTime) {
        $this->portingRequestAnswerDelayed->setAnswerduedatetime($answerDueDateTime);
        return $this;
    }

    public function setDossierId($dossierId) {
        $this->portingRequestAnswerDelayed->setDossierid($dossierId);
        return $this;
    }

    public function setDonorNetworkOperator($donorNetworkOperator) {
        $this->portingRequestAnswerDelayed->setDonornetworkoperator($donorNetworkOperator);
        return $this;
    }

    public function setDonorServiceProvider($donorServiceProvider) {
        $this->portingRequestAnswerDelayed->setDonorserviceprovider($donorServiceProvider);
        return $this;
    }

    public function setReasonCode($reasonCode) {
        $this->portingRequestAnswerDelayed->setReasoncode($reasonCode);
        return $this;
    }

    public function build() {
        $portingRequestAnswerDelayedMessage = new PortingRequestAnswerDelayedMessage();
        $portingRequestAnswerDelayedMessage->setHeader($this->header);
        $portingRequestAnswerDelayedBody = new PortingRequestAnswerDelayedBody();
        $portingRequestAnswerDelayedMessage->setBody($portingRequestAnswerDelayedBody->setPradelayed($this->portingRequestAnswerDelayed));
        return new Message($portingRequestAnswerDelayedMessage, MessageType::PORTING_REQUEST_ANSWER_DELAYED);
    }
}