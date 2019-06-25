<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\EnumDeactivationOperatorBody;
use coin\sdk\np\messages\v1\EnumDeactivationOperatorMessage;
use coin\sdk\np\messages\v1\EnumOperatorContent;
use coin\sdk\np\messages\v1\EnumOperatorRepeats;
use coin\sdk\np\messages\v1\Header;

class EnumDeactivationOperatorBuilder extends MessageBuilder
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
        $builder = new self;
        return $builder;
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
        $enumDeactivationOperatorMessage = new EnumDeactivationOperatorMessage();
        $enumDeactivationOperatorMessage->setHeader($this->header);
        $enumDeactivationOperatorBody = new EnumDeactivationOperatorBody();
        $enumDeactivationOperatorMessage->setBody($enumDeactivationOperatorBody->setEnumDeactivationoperator($this->enumOperatorContent));
        return new Message($enumDeactivationOperatorMessage, MessageType::ENUM_DEACTIVATION_OPERATOR);
    }
}