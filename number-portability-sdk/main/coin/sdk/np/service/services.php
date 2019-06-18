<?php

namespace coin\sdk\np\service\impl;

interface INumberPortabilityMessageListener {
    function onMessage($messageId, $message);
}

interface INumberPortabilityService {
    function sendConfirmation($id);
    function sendMessage($message);
}

interface IOffsetPersister {
    function getOffset();
    function setOffset($offset);
}
