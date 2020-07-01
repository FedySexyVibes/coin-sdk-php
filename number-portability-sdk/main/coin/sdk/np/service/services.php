<?php

namespace coin\sdk\np\service\impl;

use coin\sdk\np\messages\v1\ActivationServiceNumberMessage;
use coin\sdk\np\messages\v1\CancelMessage;
use coin\sdk\np\messages\v1\DeactivationMessage;
use coin\sdk\np\messages\v1\DeactivationServiceNumberMessage;
use coin\sdk\np\messages\v1\EnumActivationNumberMessage;
use coin\sdk\np\messages\v1\EnumActivationOperatorMessage;
use coin\sdk\np\messages\v1\EnumActivationRangeMessage;
use coin\sdk\np\messages\v1\EnumDeactivationNumberMessage;
use coin\sdk\np\messages\v1\EnumDeactivationOperatorMessage;
use coin\sdk\np\messages\v1\EnumDeactivationRangeMessage;
use coin\sdk\np\messages\v1\EnumProfileActivationMessage;
use coin\sdk\np\messages\v1\EnumProfileDeactivationMessage;
use coin\sdk\np\messages\v1\ErrorFoundMessage;
use coin\sdk\np\messages\v1\PortingPerformedMessage;
use coin\sdk\np\messages\v1\PortingRequestAnswerDelayedMessage;
use coin\sdk\np\messages\v1\PortingRequestAnswerMessage;
use coin\sdk\np\messages\v1\PortingRequestMessage;
use coin\sdk\np\messages\v1\RangeActivationMessage;
use coin\sdk\np\messages\v1\RangeDeactivationMessage;
use coin\sdk\np\messages\v1\TariffChangeServiceNumberMessage;

interface INumberPortabilityMessageListener {

    // Handling of keepalive messages en exceptions
    function onKeepAlive();
    function onException($exception);
    function onUnknownMessage($messageId, $message);

    // Handling of the number-portability message types
    function onActivationServiceNumber($messageId, ActivationServiceNumberMessage $message);
    function onCancel($messageId, CancelMessage $message);
    function onDeactivation($messageId, DeactivationMessage $message);
    function onDeactivationServiceNumber($messageId, DeactivationServiceNumberMessage $message);
    function onEnumActivationNumber($messageId, EnumActivationNumberMessage $message);
    function onEnumActivationOperator($messageId, EnumActivationOperatorMessage $message);
    function onEnumActivationRange($messageId, EnumActivationRangeMessage $message);
    function onEnumDeactivationNumber($messageId, EnumDeactivationNumberMessage $message);
    function onEnumDeactivationOperator($messageId, EnumDeactivationOperatorMessage $message);
    function onEnumDeactivationRange($messageId, EnumDeactivationRangeMessage $message);
    function onEnumProfileActivation($messageId, EnumProfileActivationMessage $message);
    function onEnumProfileDeactivation($messageId, EnumProfileDeactivationMessage $message);
    function onErrorFound($messageId, ErrorFoundMessage $message);
    function onPortingRequest($messageId, PortingRequestMessage $message);
    function onPortingRequestAnswer($messageId, PortingRequestAnswerMessage $message);
    function onPortingRequestAnswerDelayed($messageId, PortingRequestAnswerDelayedMessage $message);
    function onPortingPerformed($messageId, PortingPerformedMessage $message);
    function onRangeActivation($messageId, RangeActivationMessage $message);
    function onRangeDeactivation($messageId, RangeDeactivationMessage $message);
    function onTariffChangeServiceNumber($messageId, TariffChangeServiceNumberMessage $message);
}

interface INumberPortabilityService {
    function sendConfirmation($id);
    function sendMessage($message);
}
