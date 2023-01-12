# Changelog

## Version 2.1.x

Added:

- Support for Bundle Switching v5; removes the business field from contract termination requests and contract termination request answers

Update:

- Updated phpseclib to version 3 and added phpseclib2-compat to prevent issues with testing

## Version 2.x.x

Upgrade to PHP 8

## Version 1.1.0

Added:

- Support for Number Portability v3; adds the contract field to porting requests

Changed:

- Data model regenerated with Swagger codegen 3.0.25
- Package structure
- PHP 7.3

## Version 1.x.x

Version 1.0.0 has some breaking changes with regard to consuming the event stream. The new functionality is described [here](number-portability-sdk/README.md#consume-messages).
In the samples project you can find an [example](number-portability-sdk-samples/test/NumberPortabilityMessageConsumer.php) of how the new `NumberPortabilityMessageConsumer` can be used.
