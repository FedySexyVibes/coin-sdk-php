<?php

namespace coin\sdk\np\messages\v1\common;

use coin\sdk\np\messages\v1\Header;
use coin\sdk\np\messages\v1\Receiver;
use coin\sdk\np\messages\v1\Sender;

interface IMessageBuilder extends IHeaderBuilder {

    /**
     * @return Message
     */
    public function build();

    public static function create();
}

abstract class MessageBuilder implements IMessageBuilder {
    protected abstract function getThis();

    protected $header;

    protected function __construct()
    {
        $this->header = new Header();
    }

    public function setHeader($sender, $receiver)
    {
        $this->header->setSender(new Sender(array('networkoperator' => $sender)));
        $this->header->setReceiver(new Receiver(array('networkoperator' => $receiver)));
        return $this;
    }

    public function setFullHeader($senderNetworkOperator, $senderServiceProvider, $receiverNetworkOperator, $receiverServiceProvider)
    {
        $this->header->setSender(new Sender(array('networkoperator' => $senderNetworkOperator, 'serviceprovider' => $senderServiceProvider)));
        $this->header->setReceiver(new Receiver(array('networkoperator' => $receiverNetworkOperator, 'serviceprovider' => $receiverServiceProvider)));
        return $this;
    }

    public function setTimestamp($timestamp) {
        $this->header->setTimestamp($timestamp);
        return $this;
    }
}

interface EnumBuilder extends IMessageBuilder {
    public function addRepeatsItem($repeatsItem);
}
