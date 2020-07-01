<?php

namespace coin\sdk\np\messages\v1\builder;

use coin\sdk\np\messages\v1\common\EnumBuilder;
use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\NPMessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\EnumActivationOperatorBody;
use coin\sdk\np\messages\v1\EnumActivationOperatorMessage;
use coin\sdk\np\messages\v1\EnumOperatorContent;
use coin\sdk\np\messages\v1\EnumOperatorRepeats;
use coin\sdk\np\messages\v1\Header;

class EnumActivationOperatorBuilder extends NPMessageBuilder implements EnumBuilder
{
    private $enumOperatorContent;
    private $repeats;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->enumOperatorContent = new EnumOperatorContent();
        $this->header = new Header();
        $this->repeats = array();
    }

    public static function create()
    {
        return new self;
    }

    public function setCurrentNetworkOperator($currentNetworkOperator) {
        $this->enumOperatorContent->setCurrentnetworkoperator($currentNetworkOperator);
        return $this;
    }

    public function setDossierId($dossierId) {
        $this->enumOperatorContent->setDossierId($dossierId);
        return $this;
    }

    public function setTypeOfNumber($typeOfNumber) {
        $this->enumOperatorContent->setTypeofnumber($typeOfNumber);
        return $this;
    }

    public function addEnumOperatorSequence() {
        return new EnumOperatorContentBuilder($this);
    }

    public function addRepeatsItem($repeatsItem) {
        array_push($this->repeats, new EnumOperatorRepeats(["seq" => $repeatsItem]));
    }

    public function build() {
        if (sizeof($this->repeats, 0) > 0) {
            $this->enumOperatorContent->setRepeats($this->repeats);
        }
        $enumActivationOperatorMessage = new EnumActivationOperatorMessage();
        $enumActivationOperatorMessage->setHeader($this->header);
        $enumActivationOperatorBody = new EnumActivationOperatorBody();
        $enumActivationOperatorMessage->setBody($enumActivationOperatorBody->setEnumactivationoperator($this->enumOperatorContent));
        return new Message($enumActivationOperatorMessage, MessageType::ENUM_ACTIVATION_OPERATOR);
    }
}
