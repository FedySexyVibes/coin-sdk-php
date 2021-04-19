<?php

use coin\sdk\common\client\RestApiClient;
use coin\sdk\np\messages\v3\api\INumberPortabilityMessageListener;
use coin\sdk\np\messages\v3\api\NumberPortabilityMessageConsumer;
use coin\sdk\np\messages\v3\api\NumberPortabilityService;
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
use PHPUnit\Framework\TestCase;

class NumberPortabilityMessageConsumerSample extends TestCase
{
    public function testConsumeMessages()
    {
        $consumer = new NumberPortabilityMessageConsumer();
        $listener = new NPSampleListener();
        $service = new NumberPortabilityService();
        $messageIds = $consumer->consumeUnconfirmed($listener);
        // runs forever (until connection drops and all retries fail)
        foreach($messageIds as $id) {
            $service->sendConfirmation($id);
        }
        // alternatively, consume a single message by calling $messageIds->next().
    }

    public function testConsumeMessagesWithInterrupt()
    {
        $consumer = new NumberPortabilityMessageConsumer();
        $listener = new NPSampleListener();
        $service = new NumberPortabilityService();
        $stopStreamService = new StopStreamService();
        $messageIds = $consumer->consumeUnconfirmed($listener);
        // runs forever (until connection drops and all retries fail)
        $numberOfMessages = 20;
        foreach($messageIds as $id) {
            $service->sendConfirmation($id);
            $numberOfMessages--;
            if ($numberOfMessages == 0) break;
            elseif ($numberOfMessages == 10) $stopStreamService->stopStream();
        }
        $this->assertEquals(0, $numberOfMessages);
        // alternatively, consume a single message by calling $messageIds->next().
    }
}

class NPSampleListener implements INumberPortabilityMessageListener
{
    function onPortingRequest($messageId, PortingRequestMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onPortingRequestAnswer($messageId, PortingRequestAnswerMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onPortingRequestAnswerDelayed($messageId, PortingRequestAnswerDelayedMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onPortingPerformed($messageId, PortingPerformedMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onDeactivation($messageId, DeactivationMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onCancel($messageId, CancelMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onErrorFound($messageId, ErrorFoundMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onActivationServiceNumber($messageId, ActivationServiceNumberMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onDeactivationServiceNumber($messageId, DeactivationServiceNumberMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onTariffChangeServiceNumber($messageId, TariffChangeServiceNumberMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumActivationNumber($messageId, EnumActivationNumberMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumActivationOperator($messageId, EnumActivationOperatorMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumActivationRange($messageId, EnumActivationRangeMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumDeactivationNumber($messageId, EnumDeactivationNumberMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumDeactivationOperator($messageId, EnumDeactivationOperatorMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumDeactivationRange($messageId, EnumDeactivationRangeMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumProfileActivation($messageId, EnumProfileActivationMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onEnumProfileDeactivation($messageId, EnumProfileDeactivationMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onRangeActivation($messageId, RangeActivationMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onRangeDeactivation($messageId, RangeDeactivationMessage $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }

    function onKeepAlive()
    {
        echo "\nTestListener received a keepalive message";
    }

    function onException($exception)
    {
        echo "\nTestListener received an exception";
    }

    function onUnknownMessage($messageId, $message)
    {
        echo "\nTestListener received a message with an unknown type with id $messageId";
    }
}

class StopStreamService extends RestApiClient {
    private $apiUrl;

    public function __construct($consumerName = null, $privateKeyFile = null, $encryptedHmacSecretFile = null, $validPeriodInSeconds = 30, $coinBaseUrl = null) {
        parent::__construct(
            $consumerName,
            $privateKeyFile,
            $encryptedHmacSecretFile,
            $validPeriodInSeconds
        );
        $this->apiUrl = ($coinBaseUrl ?: @$_ENV['COIN_BASE_URL'] ?: $GLOBALS['CoinBaseUrl']).'/number-portability/v3';
    }

    public function stopStream() {
        $url = "$this->apiUrl/dossiers/stopstream";
        return $this->sendWithToken('GET', $url, "");
    }
}
