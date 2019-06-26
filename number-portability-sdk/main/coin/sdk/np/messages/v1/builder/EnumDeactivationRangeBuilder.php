<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\common\EnumBuilder;
use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\EnumContent;
use coin\sdk\np\messages\v1\EnumDeactivationRangeBody;
use coin\sdk\np\messages\v1\EnumDeactivationRangeMessage;
use coin\sdk\np\messages\v1\EnumNumberRepeats;
use coin\sdk\np\messages\v1\Header;

class EnumDeactivationRangeBuilder extends MessageBuilder implements EnumBuilder
{
    private $enumContent;
    private $repeats;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->enumContent = new EnumContent();
        $this->header = new Header();
        $this->repeats = array();
    }

    public static function create()
    {
        $builder = new self;
        return $builder;
    }

    public function setCurrentNetworkOperator($currentNetworkOperator) {
        $this->enumContent->setCurrentnetworkoperator($currentNetworkOperator);
        return $this;
    }

    public function setDossierId($dossierId) {
        $this->enumContent->setDossierId($dossierId);
        return $this;
    }

    public function setTypeOfNumber($typeOfNumber) {
        $this->enumContent->setTypeofnumber($typeOfNumber);
        return $this;
    }

    public function addEnumNumberSequence() {
        return new EnumContentBuilder($this);
    }

    public function addRepeatsItem($repeatsItem) {
        array_push($this->repeats, new EnumNumberRepeats(["seq" => $repeatsItem]));
    }

    public function build() {
        if (sizeof($this->repeats, 0) > 0) {
            $this->enumContent->setRepeats($this->repeats);
        }
        $enumDeactivationRangeMessage = new EnumDeactivationRangeMessage();
        $enumDeactivationRangeMessage->setHeader($this->header);
        $enumDeactivationRangeBody = new EnumDeactivationRangeBody();
        $enumDeactivationRangeMessage->setBody($enumDeactivationRangeBody->setEnumDeactivationrange($this->enumContent));
        return new Message($enumDeactivationRangeMessage, MessageType::ENUM_DEACTIVATION_RANGE);
    }
}
