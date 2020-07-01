<?php

namespace coin\sdk\bs\service\impl;

use coin\sdk\common\client\RestApiClient;
use coin\sdk\bs\messages\v4\common\Message;
use coin\sdk\bs\messages\v4\ConfirmationMessage;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class BundleSwitchingService extends RestApiClient
{

    private $apiUrl;

    public function __construct($consumerName = null, $privateKeyFile = null, $encryptedHmacSecretFile = null, $validPeriodInSeconds = 30, $coinBaseUrl = null) {
        parent::__construct(
            $consumerName,
            $privateKeyFile,
            $encryptedHmacSecretFile,
            $validPeriodInSeconds
        );
        $this->apiUrl = ($coinBaseUrl ?: @$_ENV['COIN_BASE_URL'] ?: $GLOBALS['CoinBaseUrl']).'/bundle-switching/v4';
    }

    /**
     * @param Message $message
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     */
    public function sendMessage($message) {
        return $this->postMessage($message->__toString(), $message->getMessageType());
    }

    /** @param int $id
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     */
    public function sendConfirmation($id) {
        $confirmationMessage = (new ConfirmationMessage())->setTransactionId(strval($id));
        $url = "$this->apiUrl/dossiers/confirmations/$id";
        return $this->sendWithToken('PUT', $url, $confirmationMessage->__toString());
    }

    /**
     * @param $message
     * @param $messageType
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     */
    private function postMessage($message, $messageType) {
        $url = $this->apiUrl . "/dossiers/" . $messageType;
        return $this->sendWithToken("POST", $url, $message);
    }
}
