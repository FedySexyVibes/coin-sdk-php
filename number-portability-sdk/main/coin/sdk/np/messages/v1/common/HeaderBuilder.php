<?php

namespace coin\sdk\np\messages\v1\common;

interface IHeaderBuilder
{
    public function setHeader($senderNetworkOperator, $receiverNetworkOperator, $senderServiceProvider = null, $receiverServiceProvider = null);
}
