# PHP Common SDK

## Introduction

The PHP Common SDK contains the basics for secured access to all COIN APIs.
It contains no specific API implementation. Together with all other SDKs in this git repository it is published on
[packagist](https://packagist.org/packages/coin/sdk). Run `composer require coin/sdk` in your own project to use it.

## Configure Credentials

For secure access credentials are required.
- Check [this README](https://gitlab.com/verenigingcoin-public/consumer-configuration/-/blob/master/README.md) to find out how to configure these.
- In summary, you will need:
    - a consumer name
    - a private key file
    - a file containing the encrypted Hmac secret
- These can be used to create an instance of (a child class of) the `RestApiClient`.
If you instantiate it without consumer name etc., the required values will be searched in `$_ENV` and subsequently in `$GLOBALS`
under the following names:

| $_ENV                      | $GLOBALS                |
|----------------------------|-------------------------|
| CONSUMER_NAME              | ConsumerName            |
| PRIVATE_KEY_FILE           | PrivateKeyFile          |
| ENCRYPTED_HMAC_SECRET_FILE | EncryptedHmacSecretFile |

For populating the `$_ENV` variable, [PHP dotenv](https://github.com/vlucas/phpdotenv) could be used.
