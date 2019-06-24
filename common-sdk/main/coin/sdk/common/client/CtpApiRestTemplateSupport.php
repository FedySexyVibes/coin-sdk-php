<?php

namespace coin\sdk\common\client;

use coin\sdk\common\crypto\CtpApiClientUtil;
use GuzzleHttp\Client;

abstract class CtpApiRestTemplateSupport
{

    protected $hmacSecret;
    protected $privateKey;
    protected $consumerName;
    protected $validPeriodInSeconds;

    function __construct($consumerName = null, $privateKeyFile = null, $encryptedHmacSecretFile = null, $validPeriodInSeconds = 30)
    {
        $this->privateKey = CtpApiClientUtil::readPrivateKeyFile($privateKeyFile ?: @$_ENV['PRIVATE_KEY_FILE'] ?: $GLOBALS['PrivateKeyFile']);
        $this->hmacSecret = CtpApiClientUtil::hmacSecretFromEncryptedFile($encryptedHmacSecretFile ?: @$_ENV['ENCRYPTED_HMAC_SECRET_FILE'] ?: $GLOBALS['EncryptedHmacSecretFile'], $this->privateKey);
        $this->consumerName = $consumerName ?: @$_ENV['CONSUMER_NAME'] ?: $GLOBALS['ConsumerName'];
        $this->validPeriodInSeconds = $validPeriodInSeconds;
    }

    /**
     * @param int $method
     * @param string $url
     * @param string $content [optional]
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function SendWithToken($method, $url, $content = null)
    {
        $client = new Client();
        $hmacHeaders = CtpApiClientUtil::getHmacHeaders($content);
        $methodName = $method;
        $localPath = parse_url($url, PHP_URL_PATH);
        $requestLine = "$methodName $localPath HTTP/1.1";
        $hmac = CtpApiClientUtil::CalculateHttpRequestHmac($this->hmacSecret, $this->consumerName, $hmacHeaders, $requestLine);
        $jwt = CtpApiClientUtil::createJwt($this->privateKey, $this->consumerName, $this->validPeriodInSeconds);
        return $client->request($method, $url, [
            'body' => $content,
            'headers' => array_merge($hmacHeaders, array(
                "Authorization" => $hmac,
                "User-Agent" => "coin-sdk-php-v0.0.0",
                'Content-Type' => 'application/json; charset=utf-8',
                "cookie" => "jwt=$jwt; path=$localPath")
            )
        ]);

    }
}
