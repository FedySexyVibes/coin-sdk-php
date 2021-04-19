<?php

namespace coin\sdk\np\messages\v3\api;

use coin\sdk\np\messages\v3\model\ActivationServiceNumberMessage;
use coin\sdk\np\messages\v3\model\CancelMessage;
use coin\sdk\np\messages\v3\model\DeactivationMessage;
use coin\sdk\np\messages\v3\model\DeactivationServiceNumberMessage;
use coin\sdk\np\messages\v3\model\EnumActivationNumberMessage;
use coin\sdk\np\messages\v3\model\EnumActivationOperatorMessage;
use coin\sdk\np\messages\v3\model\EnumActivationRangeMessage;
use coin\sdk\np\messages\v3\model\EnumDeactivationNumberMessage;
use coin\sdk\np\messages\v3\model\EnumDeactivationOperatorMessage;
use coin\sdk\np\messages\v3\model\EnumDeactivationRangeMessage;
use coin\sdk\np\messages\v3\model\EnumProfileActivationMessage;
use coin\sdk\np\messages\v3\model\EnumProfileDeactivationMessage;
use coin\sdk\np\messages\v3\model\ErrorFoundMessage;
use coin\sdk\np\messages\v3\model\PortingPerformedMessage;
use coin\sdk\np\messages\v3\model\PortingRequestAnswerDelayedMessage;
use coin\sdk\np\messages\v3\model\PortingRequestAnswerMessage;
use coin\sdk\np\messages\v3\model\PortingRequestMessage;
use coin\sdk\np\messages\v3\model\RangeActivationMessage;
use coin\sdk\np\messages\v3\model\RangeDeactivationMessage;
use coin\sdk\np\messages\v3\model\TariffChangeServiceNumberMessage;

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
