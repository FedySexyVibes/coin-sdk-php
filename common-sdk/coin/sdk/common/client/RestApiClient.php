<?php

namespace coin\sdk\common\client;

use coin\sdk\common\crypto\ApiClientUtil;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

abstract class RestApiClient
{
    public static function getFullVersion() {
        // NOTE: automatically updated by pre_tag_command
        return 'coin-sdk-php-1.0.2';
    }

    protected $hmacSecret;
    protected $privateKey;
    protected $consumerName;
    protected $validPeriodInSeconds;

    function __construct($consumerName = null, $privateKeyFile = null, $encryptedHmacSecretFile = null, $validPeriodInSeconds = 30)
    {
        $this->privateKey = ApiClientUtil::readPrivateKeyFile($privateKeyFile ?: @$_ENV['PRIVATE_KEY_FILE'] ?: $GLOBALS['PrivateKeyFile']);
        $this->hmacSecret = ApiClientUtil::hmacSecretFromEncryptedFile($encryptedHmacSecretFile ?: @$_ENV['ENCRYPTED_HMAC_SECRET_FILE'] ?: $GLOBALS['EncryptedHmacSecretFile'], $this->privateKey);
        $this->consumerName = $consumerName ?: @$_ENV['CONSUMER_NAME'] ?: $GLOBALS['ConsumerName'];
        $this->validPeriodInSeconds = $validPeriodInSeconds;
    }

    /**
     * @param int $method
     * @param string $url
     * @param string $content [optional]
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     */
    protected function sendWithToken($method, $url, $content = null)
    {
        $client = new Client();
        $hmacHeaders = ApiClientUtil::getHmacHeaders($content);
        $methodName = $method;
        $localPath = parse_url($url, PHP_URL_PATH);
        $requestLine = "$methodName $localPath HTTP/1.1";
        $hmac = ApiClientUtil::CalculateHttpRequestHmac($this->hmacSecret, $this->consumerName, $hmacHeaders, $requestLine);
        $jwt = ApiClientUtil::createJwt($this->privateKey, $this->consumerName, $this->validPeriodInSeconds);
        return $client->request($method, $url, [
            'body' => $content,
            'headers' => array_merge($hmacHeaders, array(
                "Authorization" => $hmac,
                "User-Agent" => $this::getFullVersion(),
                'Content-Type' => 'application/json; charset=utf-8',
                "cookie" => "jwt=$jwt; path=$localPath")
            )
        ]);

    }
}
