<?php

namespace coin\sdk\np\messages\v1\common;

interface IHeaderBuilder
{
    public function setHeader($sender, $receiver);

    public function setFullHeader($senderNetworkOperator, $senderServiceProvider, $receiverNetworkOperator, $receiverServiceProvider);
}
