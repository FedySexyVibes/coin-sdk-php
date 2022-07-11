<?php
/**
 * InfraBlock
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

namespace coin\sdk\bs\messages\v4;

use \ArrayAccess;
use InvalidArgumentException;
use coin\sdk\bs\ObjectSerializer;

/**
 * InfraBlock Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class InfraBlock implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'InfraBlock';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'infraprovider' => 'string',
        'infratype' => 'string',
        'infraid' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'infraprovider' => null,
        'infratype' => null,
        'infraid' => null
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
        'infraprovider' => 'infraprovider',
        'infratype' => 'infratype',
        'infraid' => 'infraid'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'infraprovider' => 'setInfraprovider',
        'infratype' => 'setInfratype',
        'infraid' => 'setInfraid'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'infraprovider' => 'getInfraprovider',
        'infratype' => 'getInfratype',
        'infraid' => 'getInfraid'
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
        $this->container['infraprovider'] = isset($data['infraprovider']) ? $data['infraprovider'] : null;
        $this->container['infratype'] = isset($data['infratype']) ? $data['infratype'] : null;
        $this->container['infraid'] = isset($data['infraid']) ? $data['infraid'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if (!is_null($this->container['infraprovider']) && (mb_strlen($this->container['infraprovider']) > 6)) {
            $invalidProperties[] = "invalid value for 'infraprovider', the character length must be smaller than or equal to 6.";
        }

        if (!is_null($this->container['infraprovider']) && (mb_strlen($this->container['infraprovider']) < 1)) {
            $invalidProperties[] = "invalid value for 'infraprovider', the character length must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['infratype']) && (mb_strlen($this->container['infratype']) > 200)) {
            $invalidProperties[] = "invalid value for 'infratype', the character length must be smaller than or equal to 200.";
        }

        if (!is_null($this->container['infratype']) && (mb_strlen($this->container['infratype']) < 1)) {
            $invalidProperties[] = "invalid value for 'infratype', the character length must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['infraid']) && (mb_strlen($this->container['infraid']) > 100)) {
            $invalidProperties[] = "invalid value for 'infraid', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['infraid']) && (mb_strlen($this->container['infraid']) < 1)) {
            $invalidProperties[] = "invalid value for 'infraid', the character length must be bigger than or equal to 1.";
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
     * Gets infraprovider
     *
     * @return string
     */
    public function getInfraprovider()
    {
        return $this->container['infraprovider'];
    }

    /**
     * Sets infraprovider
     *
     * @param string $infraprovider Provider of the infra of the line
     *
     * @return $this
     */
    public function setInfraprovider($infraprovider)
    {
        if (!is_null($infraprovider) && (mb_strlen($infraprovider) > 6)) {
            throw new InvalidArgumentException('invalid length for $infraprovider when calling InfraBlock., must be smaller than or equal to 6.');
        }
        if (!is_null($infraprovider) && (mb_strlen($infraprovider) < 1)) {
            throw new InvalidArgumentException('invalid length for $infraprovider when calling InfraBlock., must be bigger than or equal to 1.');
        }

        $this->container['infraprovider'] = $infraprovider;

        return $this;
    }

    /**
     * Gets infratype
     *
     * @return string
     */
    public function getInfratype()
    {
        return $this->container['infratype'];
    }

    /**
     * Sets infratype
     *
     * @param string $infratype Type of infra of the line
     *
     * @return $this
     */
    public function setInfratype($infratype)
    {
        if (!is_null($infratype) && (mb_strlen($infratype) > 200)) {
            throw new InvalidArgumentException('invalid length for $infratype when calling InfraBlock., must be smaller than or equal to 200.');
        }
        if (!is_null($infratype) && (mb_strlen($infratype) < 1)) {
            throw new InvalidArgumentException('invalid length for $infratype when calling InfraBlock., must be bigger than or equal to 1.');
        }

        $this->container['infratype'] = $infratype;

        return $this;
    }

    /**
     * Gets infraid
     *
     * @return string
     */
    public function getInfraid()
    {
        return $this->container['infraid'];
    }

    /**
     * Sets infraid
     *
     * @param string $infraid Id of the infra of the line
     *
     * @return $this
     */
    public function setInfraid($infraid)
    {
        if (!is_null($infraid) && (mb_strlen($infraid) > 100)) {
            throw new InvalidArgumentException('invalid length for $infraid when calling InfraBlock., must be smaller than or equal to 100.');
        }
        if (!is_null($infraid) && (mb_strlen($infraid) < 1)) {
            throw new InvalidArgumentException('invalid length for $infraid when calling InfraBlock., must be bigger than or equal to 1.');
        }

        $this->container['infraid'] = $infraid;

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


