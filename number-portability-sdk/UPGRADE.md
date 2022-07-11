# Version 2.x.x

Upgrade to PHP 8

# Version 1.1.0

Added:

- Support for the number portability api v3

Changed:

- Data model regenerated with Swagger codegen 3.0.25
- Package structure
- PHP 7.3

# Upgrading to version 1.x.x

Version 1.0.0 has some breaking changes with regard to consuming the event stream. The new functionality is described [here](./README.md#consume-messages).
In the samples project you can find an [example](../number-portability-sdk-samples/test/NumberPortabilityMessageConsumer.php) of how the new `NumberPortabilityMessageConsumer` can be used.
