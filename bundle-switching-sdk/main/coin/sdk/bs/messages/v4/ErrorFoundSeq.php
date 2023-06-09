<?php
/**
 * ErrorFoundSeq
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
 * ErrorFoundSeq Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ErrorFoundSeq implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ErrorFoundSeq';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'phonenumber' => 'string',
        'errorcode' => 'string',
        'description' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'phonenumber' => null,
        'errorcode' => null,
        'description' => null
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
        'phonenumber' => 'phonenumber',
        'errorcode' => 'errorcode',
        'description' => 'description'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'phonenumber' => 'setPhonenumber',
        'errorcode' => 'setErrorcode',
        'description' => 'setDescription'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'phonenumber' => 'getPhonenumber',
        'errorcode' => 'getErrorcode',
        'description' => 'getDescription'
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
        $this->container['phonenumber'] = isset($data['phonenumber']) ? $data['phonenumber'] : null;
        $this->container['errorcode'] = isset($data['errorcode']) ? $data['errorcode'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if (!is_null($this->container['phonenumber']) && (mb_strlen($this->container['phonenumber']) > 20)) {
            $invalidProperties[] = "invalid value for 'phonenumber', the character length must be smaller than or equal to 20.";
        }

        if (!is_null($this->container['phonenumber']) && (mb_strlen($this->container['phonenumber']) < 0)) {
            $invalidProperties[] = "invalid value for 'phonenumber', the character length must be bigger than or equal to 0.";
        }

        if ($this->container['errorcode'] === null) {
            $invalidProperties[] = "'errorcode' can't be null";
        }
        if ((mb_strlen($this->container['errorcode']) > 20)) {
            $invalidProperties[] = "invalid value for 'errorcode', the character length must be smaller than or equal to 20.";
        }

        if ((mb_strlen($this->container['errorcode']) < 1)) {
            $invalidProperties[] = "invalid value for 'errorcode', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ((mb_strlen($this->container['description']) > 1000)) {
            $invalidProperties[] = "invalid value for 'description', the character length must be smaller than or equal to 1000.";
        }

        if ((mb_strlen($this->container['description']) < 1)) {
            $invalidProperties[] = "invalid value for 'description', the character length must be bigger than or equal to 1.";
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
     * Gets phonenumber
     *
     * @return string
     */
    public function getPhonenumber()
    {
        return $this->container['phonenumber'];
    }

    /**
     * Sets phonenumber
     *
     * @param string $phonenumber [reserved for future use]
     *
     * @return $this
     */
    public function setPhonenumber($phonenumber)
    {
        if (!is_null($phonenumber) && (mb_strlen($phonenumber) > 20)) {
            throw new InvalidArgumentException('invalid length for $phonenumber when calling ErrorFoundSeq., must be smaller than or equal to 20.');
        }
        if (!is_null($phonenumber) && (mb_strlen($phonenumber) < 0)) {
            throw new InvalidArgumentException('invalid length for $phonenumber when calling ErrorFoundSeq., must be bigger than or equal to 0.');
        }

        $this->container['phonenumber'] = $phonenumber;

        return $this;
    }

    /**
     * Gets errorcode
     *
     * @return string
     */
    public function getErrorcode()
    {
        return $this->container['errorcode'];
    }

    /**
     * Sets errorcode
     *
     * @param string $errorcode Id for the error situation
     *
     * @return $this
     */
    public function setErrorcode($errorcode)
    {
        if ((mb_strlen($errorcode) > 20)) {
            throw new InvalidArgumentException('invalid length for $errorcode when calling ErrorFoundSeq., must be smaller than or equal to 20.');
        }
        if ((mb_strlen($errorcode) < 1)) {
            throw new InvalidArgumentException('invalid length for $errorcode when calling ErrorFoundSeq., must be bigger than or equal to 1.');
        }

        $this->container['errorcode'] = $errorcode;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description Description of the errorcode
     *
     * @return $this
     */
    public function setDescription($description)
    {
        if ((mb_strlen($description) > 1000)) {
            throw new InvalidArgumentException('invalid length for $description when calling ErrorFoundSeq., must be smaller than or equal to 1000.');
        }
        if ((mb_strlen($description) < 1)) {
            throw new InvalidArgumentException('invalid length for $description when calling ErrorFoundSeq., must be bigger than or equal to 1.');
        }

        $this->container['description'] = $description;

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


