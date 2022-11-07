# COIN SDKs for PHP

[![Latest Stable Version](https://img.shields.io/packagist/v/coin/sdk.svg?style=flat-square)](https://packagist.org/packages/coin/sdk)
[![CI Status](https://gitlab.com/verenigingcoin-public/coin-sdk-php/badges/master/pipeline.svg)](https://gitlab.com/verenigingcoin-public/coin-sdk-php/-/pipelines/latest)

| Api                                                                   | SDK Version   | Api Version                                          | Changelog                          |
|-----------------------------------------------------------------------|---------------|------------------------------------------------------|------------------------------------|
| [number-portability](https://coin.nl/en/services/nummerportabiliteit) | 1.1.0 +       | [v3](https://api.coin.nl/docs/number-portability/v3) | [here](CHANGELOG.md#version-1.1.0) |
|                                                                       | 0.0.0 - 1.0.2 | [v1](https://api.coin.nl/docs/number-portability/v1) | -                                  |
| [bundle-switching](https://coin.nl/en/services/overstappen)           | 2.1.0 +       | [v5](https://api.coin.nl/docs/bundle-switching/v4)   | [here](CHANGELOG.md#version-2.1.0) |
|                                                                       | 1.1.0 - 2.0.2 | [v4](https://api.coin.nl/docs/bundle-switching/v4)   | -                                  |

This project contains SDKs for various COIN APIs.
- [Number Portability](number-portability-sdk/README.md)
- [Bundle Switching](bundle-switching-sdk/README.md)
- For other APIs you can use [Common](common-sdk/README.md) to add correct credentials to your requests

To use an SDK, you need to [configure a consumer](https://gitlab.com/verenigingcoin-public/consumer-configuration/-/blob/master/README.md).

## Support
If you need support, feel free to send an email to the [COIN devops team](mailto:devops@coin.nl).


## Local Development

To run the tests locally:

```bash
CI_JOB_ID=local ./setup/start-docker-compose
CI_JOB_ID=local ./setup/run-tests
```
