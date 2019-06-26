<?php

use coin\sdk\common\client\RestApiClient;
use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\ConfirmationMessage;

class NumberPortabilityService extends RestApiClient
{

    private $apiUrl;

    public function __construct($consumerName = null, $privateKeyFile = null, $encryptedHmacSecretFile = null, $validPeriodInSeconds = 30, $coinBaseUrl = null) {
        parent::__construct(
            $consumerName,
            $privateKeyFile,
            $encryptedHmacSecretFile,
            $validPeriodInSeconds
        );
        $this->apiUrl = ($coinBaseUrl ?: @$_ENV['COIN_BASE_URL'] ?: $GLOBALS['CoinBaseUrl']).'/number-portability/v1';
    }

    /**
     * @param Message $message
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMessage($message) {
        return $this->postMessage($message->__toString(), $message->getMessageType());
    }

    /** @param int $id
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendConfirmation($id) {
        $confirmationMessage = (new ConfirmationMessage())->setTransactionId(strval($id));
        $url = "$this->apiUrl/dossiers/confirmations/$id";
        return $this->sendWithToken('PUT', $url, $confirmationMessage->__toString());
    }

    /**
     * @param $message
     * @param $messageType
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function postMessage($message, $messageType) {
        $url = $this->apiUrl . "/dossiers/" . $messageType;
        return $this->sendWithToken("POST", $url, $message);
    }
}
