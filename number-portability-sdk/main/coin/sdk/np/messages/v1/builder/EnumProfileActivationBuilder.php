<?php


namespace coin\sdk\np\messages\v1\builder;

use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\NPMessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\EnumProfileActivation;
use coin\sdk\np\messages\v1\EnumProfileActivationBody;
use coin\sdk\np\messages\v1\EnumProfileActivationMessage;
use coin\sdk\np\messages\v1\Header;

class EnumProfileActivationBuilder extends NPMessageBuilder
{
    private $enumProfileActivation;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->enumProfileActivation = new EnumProfileActivation();
        $this->header = new Header();
    }

    public function setCurrentNetworkOperator($currentNetworkOperator) {
        $this->enumProfileActivation->setCurrentnetworkoperator($currentNetworkOperator);
        return $this;
    }

    public function setDnsClass($dnsClass) {
        $this->enumProfileActivation->setDnsclass($dnsClass);
        return $this;
    }

    public function setDomain($domain) {
        $this->enumProfileActivation->setDomain($domain);
        return $this;
    }

    public function setDomainTag($domainTag) {
        $this->enumProfileActivation->setDomaintag($domainTag);
        return $this;
    }

    public function setDossierId($dossierId) {
        $this->enumProfileActivation->setDossierId($dossierId);
        return $this;
    }

    public function setEnumService($enumService) {
        $this->enumProfileActivation->setEnumservice($enumService);
        return $this;
    }

    public function setFlags($flags) {
        $this->enumProfileActivation->setFlags($flags);
        return $this;
    }

    public function setGateway($gateway) {
        $this->enumProfileActivation->setGateway($gateway);
        return $this;
    }

    public function setOrder($order) {
        $this->enumProfileActivation->setOrder($order);
        return $this;
    }

    public function setPreference($preference) {
        $this->enumProfileActivation->setPreference($preference);
        return $this;
    }

    public function setProcessType($processType) {
        $this->enumProfileActivation->setProcesstype($processType);
        return $this;
    }

    public function setProfileId($profileId) {
        $this->enumProfileActivation->setProfileid($profileId);
        return $this;
    }

    public function setRecType($recType) {
        $this->enumProfileActivation->setRectype($recType);
        return $this;
    }

    public function setRegExp($recExp) {
        $this->enumProfileActivation->setRegExp($recExp);
        return $this;
    }

    public function setReplacement($replacement) {
        $this->enumProfileActivation->setReplacement($replacement);
        return $this;
    }

    public function setScope($scope) {
        $this->enumProfileActivation->setScope($scope);
        return $this;
    }

    public function setService($service) {
        $this->enumProfileActivation->setService($service);
        return $this;
    }

    public function setSpCode($spCode) {
        $this->enumProfileActivation->setSpcode($spCode);
        return $this;
    }

    public function setTtl($ttl) {
        $this->enumProfileActivation->setTtl($ttl);
        return $this;
    }

    public function setTypeOfNumber($typeOfNumber) {
        $this->enumProfileActivation->setTypeofnumber($typeOfNumber);
        return $this;
    }

    public function setUserTag($userTag) {
        $this->enumProfileActivation->setUserTag($userTag);
        return $this;
    }

    public static function create()
    {
        return new self;
    }

    public function build() {
        $enumProfileActivationMessage = new EnumProfileActivationMessage();
        $enumProfileActivationMessage->setHeader($this->header);
        $enumProfileActivationBody = new EnumProfileActivationBody();
        $enumProfileActivationMessage->setBody($enumProfileActivationBody->setEnumprofileactivation($this->enumProfileActivation));
        return new Message($enumProfileActivationMessage, MessageType::ENUM_PROFILE_ACTIVATION);
    }
}
