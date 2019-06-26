<?php

namespace coin\sdk\np\messages\v1\builder;

use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\Header;
use coin\sdk\np\messages\v1\NumberSeries;
use coin\sdk\np\messages\v1\PortingRequestAnswer;
use coin\sdk\np\messages\v1\PortingRequestAnswerBody;
use coin\sdk\np\messages\v1\PortingRequestAnswerMessage;
use coin\sdk\np\messages\v1\PortingRequestAnswerRepeats;
use coin\sdk\np\messages\v1\PortingRequestAnswerSeq;

class PortingRequestAnswerSequenceBuilder {

    private $portingRequestAnswerSequence;
    private $parent;

    public function __construct(PortingRequestAnswerBuilder $parent) {
        $this->parent = $parent;
        $this->portingRequestAnswerSequence = new PortingRequestAnswerSeq();
    }

    public function setNumberSeries($start, $end) {
        $numberSeries = new NumberSeries();
        $numberSeries->setStart($start);
        $numberSeries->setEnd($end);
        $this->portingRequestAnswerSequence->setNumberseries($numberSeries);
        return $this;
    }

    public function setNote($note) {
        $this->portingRequestAnswerSequence->setNote($note);
        return $this;
    }

    public function setFirstPossibleDate($firstPossibleDate) {
        $this->portingRequestAnswerSequence->setFirstpossibledate($firstPossibleDate);
        return $this;
    }

    public function setBlockingCode($blockingCode) {
        $this->portingRequestAnswerSequence->setBlockingcode($blockingCode);
        return $this;
    }

    public function setDonorNetworkOperator($donorNetworkOperator) {
        $this->portingRequestAnswerSequence->setDonornetworkoperator($donorNetworkOperator);
        return $this;
    }

    public function setDonorServiceProvider($donorServiceProvider) {
        $this->portingRequestAnswerSequence->setDonorserviceprovider($donorServiceProvider);
        return $this;
    }

    public function finish() {
        $this->parent->addRepeatsItem($this->portingRequestAnswerSequence);
        return $this->parent;
    }
}

class PortingRequestAnswerBuilder extends MessageBuilder
{
    private $portingRequestAnswer;
    private $repeats;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->portingRequestAnswer = new PortingRequestAnswer();
        $this->header = new Header();
        $this->repeats = array();
    }

    public static function create()
    {
        $builder = new self;
        return $builder;
    }

    public function setDossierId($dossierId) {
        $this->portingRequestAnswer->setDossierid($dossierId);
        return $this;
    }

    public function setBlocking($blocking) {
        $this->portingRequestAnswer->setBlocking($blocking);
        return $this;
    }

    public function addPortingRequestAnswerSequence() {
        return new PortingRequestAnswerSequenceBuilder($this);
    }

    public function addRepeatsItem($repeatsItem) {
        array_push($this->repeats, new PortingRequestAnswerRepeats(["seq" => $repeatsItem]));
    }


    public function build() {
        if (sizeof($this->repeats, 0) > 0) {
            $this->portingRequestAnswer->setRepeats($this->repeats);
        }
        $portingRequestAnswerMessage = new PortingRequestAnswerMessage();
        $portingRequestAnswerMessage->setHeader($this->header);
        $portingRequestAnswerBody = new PortingRequestAnswerBody();
        $portingRequestAnswerMessage->setBody($portingRequestAnswerBody->setPortingrequestanswer($this->portingRequestAnswer));
        return new Message($portingRequestAnswerMessage, MessageType::PORTING_REQUEST_ANSWER);
    }
}
