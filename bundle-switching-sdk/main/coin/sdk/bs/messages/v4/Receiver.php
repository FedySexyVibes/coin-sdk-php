<?php
/**
 * Receiver
 *
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * COIN Bundle Switching Rest API
 *
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * Contact: servicedesk@coin.nl
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.14
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace coin\sdk\bs\messages\v5;

use \ArrayAccess;
use InvalidArgumentException;
use coin\sdk\bs\ObjectSerializer;

/**
 * Receiver Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Receiver implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Receiver';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'networkoperator' => 'string',
        'serviceprovider' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'networkoperator' => null,
        'serviceprovider' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'networkoperator' => 'networkoperator',
        'serviceprovider' => 'serviceprovider'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'networkoperator' => 'setNetworkoperator',
        'serviceprovider' => 'setServiceprovider'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'networkoperator' => 'getNetworkoperator',
        'serviceprovider' => 'getServiceprovider'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }





    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['networkoperator'] = isset($data['networkoperator']) ? $data['networkoperator'] : null;
        $this->container['serviceprovider'] = isset($data['serviceprovider']) ? $data['serviceprovider'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if (!is_null($this->container['networkoperator']) && !preg_match("/^[0-9A-Z]{3,6}$/", $this->container['networkoperator'])) {
            $invalidProperties[] = "invalid value for 'networkoperator', must be conform to the pattern /^[0-9A-Z]{3,6}$/.";
        }

        if ($this->container['serviceprovider'] === null) {
            $invalidProperties[] = "'serviceprovider' can't be null";
        }
        if (!preg_match("/^[0-9A-Z]{3,6}$/", $this->container['serviceprovider'])) {
            $invalidProperties[] = "invalid value for 'serviceprovider', must be conform to the pattern /^[0-9A-Z]{3,6}$/.";
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets networkoperator
     *
     * @return string
     */
    public function getNetworkoperator()
    {
        return $this->container['networkoperator'];
    }

    /**
     * Sets networkoperator
     *
     * @param string $networkoperator Code of the destination of the message.
     *
     * @return $this
     */
    public function setNetworkoperator($networkoperator)
    {

        if (!is_null($networkoperator) && (!preg_match("/^[0-9A-Z]{3,6}$/", $networkoperator))) {
            throw new InvalidArgumentException("invalid value for $networkoperator when calling Receiver., must conform to the pattern /^[0-9A-Z]{3,6}$/.");
        }

        $this->container['networkoperator'] = $networkoperator;

        return $this;
    }

    /**
     * Gets serviceprovider
     *
     * @return string
     */
    public function getServiceprovider()
    {
        return $this->container['serviceprovider'];
    }

    /**
     * Sets serviceprovider
     *
     * @param string $serviceprovider Code of the destination of the message.
     *
     * @return $this
     */
    public function setServiceprovider($serviceprovider)
    {

        if ((!preg_match("/^[0-9A-Z]{3,6}$/", $serviceprovider))) {
            throw new InvalidArgumentException("invalid value for $serviceprovider when calling Receiver., must conform to the pattern /^[0-9A-Z]{3,6}$/.");
        }

        $this->container['serviceprovider'] = $serviceprovider;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


