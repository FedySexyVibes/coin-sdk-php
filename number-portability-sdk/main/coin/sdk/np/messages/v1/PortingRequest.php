<?php
/**
 * PortingRequest
 *
 * PHP version 5
 *
 * @category Class
 * @package  coin\sdk\np
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * COIN CRDB Rest API
 *
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * Contact: devops@coin.nl
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 3.0.8
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace coin\sdk\np\messages\v1;

use \ArrayAccess;
use \coin\sdk\np\ObjectSerializer;

/**
 * PortingRequest Class Doc Comment
 *
 * @category Class
 * @package  coin\sdk\np
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PortingRequest implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'PortingRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'dossierid' => 'string',
'recipientserviceprovider' => 'string',
'recipientnetworkoperator' => 'string',
'donornetworkoperator' => 'string',
'donorserviceprovider' => 'string',
'customerinfo' => '\coin\sdk\np\messages\v1\CustomerInfo',
'note' => 'string',
'repeats' => '\coin\sdk\np\messages\v1\PortingRequestRepeats[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'dossierid' => null,
'recipientserviceprovider' => null,
'recipientnetworkoperator' => null,
'donornetworkoperator' => null,
'donorserviceprovider' => null,
'customerinfo' => null,
'note' => null,
'repeats' => null    ];

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
        'dossierid' => 'dossierid',
'recipientserviceprovider' => 'recipientserviceprovider',
'recipientnetworkoperator' => 'recipientnetworkoperator',
'donornetworkoperator' => 'donornetworkoperator',
'donorserviceprovider' => 'donorserviceprovider',
'customerinfo' => 'customerinfo',
'note' => 'note',
'repeats' => 'repeats'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'dossierid' => 'setDossierid',
'recipientserviceprovider' => 'setRecipientserviceprovider',
'recipientnetworkoperator' => 'setRecipientnetworkoperator',
'donornetworkoperator' => 'setDonornetworkoperator',
'donorserviceprovider' => 'setDonorserviceprovider',
'customerinfo' => 'setCustomerinfo',
'note' => 'setNote',
'repeats' => 'setRepeats'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'dossierid' => 'getDossierid',
'recipientserviceprovider' => 'getRecipientserviceprovider',
'recipientnetworkoperator' => 'getRecipientnetworkoperator',
'donornetworkoperator' => 'getDonornetworkoperator',
'donorserviceprovider' => 'getDonorserviceprovider',
'customerinfo' => 'getCustomerinfo',
'note' => 'getNote',
'repeats' => 'getRepeats'    ];

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
        $this->container['dossierid'] = isset($data['dossierid']) ? $data['dossierid'] : null;
        $this->container['recipientserviceprovider'] = isset($data['recipientserviceprovider']) ? $data['recipientserviceprovider'] : null;
        $this->container['recipientnetworkoperator'] = isset($data['recipientnetworkoperator']) ? $data['recipientnetworkoperator'] : null;
        $this->container['donornetworkoperator'] = isset($data['donornetworkoperator']) ? $data['donornetworkoperator'] : null;
        $this->container['donorserviceprovider'] = isset($data['donorserviceprovider']) ? $data['donorserviceprovider'] : null;
        $this->container['customerinfo'] = isset($data['customerinfo']) ? $data['customerinfo'] : null;
        $this->container['note'] = isset($data['note']) ? $data['note'] : null;
        $this->container['repeats'] = isset($data['repeats']) ? $data['repeats'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['dossierid'] === null) {
            $invalidProperties[] = "'dossierid' can't be null";
        }
        if ($this->container['recipientnetworkoperator'] === null) {
            $invalidProperties[] = "'recipientnetworkoperator' can't be null";
        }
        if ($this->container['repeats'] === null) {
            $invalidProperties[] = "'repeats' can't be null";
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
     * Gets dossierid
     *
     * @return string
     */
    public function getDossierid()
    {
        return $this->container['dossierid'];
    }

    /**
     * Sets dossierid
     *
     * @param string $dossierid dossierid
     *
     * @return $this
     */
    public function setDossierid($dossierid)
    {
        $this->container['dossierid'] = $dossierid;

        return $this;
    }

    /**
     * Gets recipientserviceprovider
     *
     * @return string
     */
    public function getRecipientserviceprovider()
    {
        return $this->container['recipientserviceprovider'];
    }

    /**
     * Sets recipientserviceprovider
     *
     * @param string $recipientserviceprovider recipientserviceprovider
     *
     * @return $this
     */
    public function setRecipientserviceprovider($recipientserviceprovider)
    {
        $this->container['recipientserviceprovider'] = $recipientserviceprovider;

        return $this;
    }

    /**
     * Gets recipientnetworkoperator
     *
     * @return string
     */
    public function getRecipientnetworkoperator()
    {
        return $this->container['recipientnetworkoperator'];
    }

    /**
     * Sets recipientnetworkoperator
     *
     * @param string $recipientnetworkoperator recipientnetworkoperator
     *
     * @return $this
     */
    public function setRecipientnetworkoperator($recipientnetworkoperator)
    {
        $this->container['recipientnetworkoperator'] = $recipientnetworkoperator;

        return $this;
    }

    /**
     * Gets donornetworkoperator
     *
     * @return string
     */
    public function getDonornetworkoperator()
    {
        return $this->container['donornetworkoperator'];
    }

    /**
     * Sets donornetworkoperator
     *
     * @param string $donornetworkoperator donornetworkoperator
     *
     * @return $this
     */
    public function setDonornetworkoperator($donornetworkoperator)
    {
        $this->container['donornetworkoperator'] = $donornetworkoperator;

        return $this;
    }

    /**
     * Gets donorserviceprovider
     *
     * @return string
     */
    public function getDonorserviceprovider()
    {
        return $this->container['donorserviceprovider'];
    }

    /**
     * Sets donorserviceprovider
     *
     * @param string $donorserviceprovider donorserviceprovider
     *
     * @return $this
     */
    public function setDonorserviceprovider($donorserviceprovider)
    {
        $this->container['donorserviceprovider'] = $donorserviceprovider;

        return $this;
    }

    /**
     * Gets customerinfo
     *
     * @return \coin\sdk\np\messages\v1\CustomerInfo
     */
    public function getCustomerinfo()
    {
        return $this->container['customerinfo'];
    }

    /**
     * Sets customerinfo
     *
     * @param \coin\sdk\np\messages\v1\CustomerInfo $customerinfo customerinfo
     *
     * @return $this
     */
    public function setCustomerinfo($customerinfo)
    {
        $this->container['customerinfo'] = $customerinfo;

        return $this;
    }

    /**
     * Gets note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->container['note'];
    }

    /**
     * Sets note
     *
     * @param string $note note
     *
     * @return $this
     */
    public function setNote($note)
    {
        $this->container['note'] = $note;

        return $this;
    }

    /**
     * Gets repeats
     *
     * @return \coin\sdk\np\messages\v1\PortingRequestRepeats[]
     */
    public function getRepeats()
    {
        return $this->container['repeats'];
    }

    /**
     * Sets repeats
     *
     * @param \coin\sdk\np\messages\v1\PortingRequestRepeats[] $repeats repeats
     *
     * @return $this
     */
    public function setRepeats($repeats)
    {
        $this->container['repeats'] = $repeats;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
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
    public function offsetGet($offset)
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
    public function offsetSet($offset, $value)
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
    public function offsetUnset($offset)
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
