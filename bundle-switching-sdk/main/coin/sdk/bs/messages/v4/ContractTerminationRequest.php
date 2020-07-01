<?php
/**
 * ContractTerminationRequest
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
use \Swagger\Client\ObjectSerializer;

/**
 * ContractTerminationRequest Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ContractTerminationRequest implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ContractTerminationRequest';

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
        'business' => 'string',
        'earlytermination' => 'string',
        'name' => 'string',
        'addressblock' => '\coin\sdk\bs\messages\v4\AddressBlock',
        'numberseries' => '\coin\sdk\bs\messages\v4\NumberSeries[]',
        'validationblock' => '\coin\sdk\bs\messages\v4\ValidationBlock[]',
        'note' => 'string'
    ];

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
        'business' => null,
        'earlytermination' => null,
        'name' => null,
        'addressblock' => null,
        'numberseries' => null,
        'validationblock' => null,
        'note' => null
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
        'dossierid' => 'dossierid',
        'recipientserviceprovider' => 'recipientserviceprovider',
        'recipientnetworkoperator' => 'recipientnetworkoperator',
        'donornetworkoperator' => 'donornetworkoperator',
        'donorserviceprovider' => 'donorserviceprovider',
        'business' => 'business',
        'earlytermination' => 'earlytermination',
        'name' => 'name',
        'addressblock' => 'addressblock',
        'numberseries' => 'numberseries',
        'validationblock' => 'validationblock',
        'note' => 'note'
    ];

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
        'business' => 'setBusiness',
        'earlytermination' => 'setEarlytermination',
        'name' => 'setName',
        'addressblock' => 'setAddressblock',
        'numberseries' => 'setNumberseries',
        'validationblock' => 'setValidationblock',
        'note' => 'setNote'
    ];

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
        'business' => 'getBusiness',
        'earlytermination' => 'getEarlytermination',
        'name' => 'getName',
        'addressblock' => 'getAddressblock',
        'numberseries' => 'getNumberseries',
        'validationblock' => 'getValidationblock',
        'note' => 'getNote'
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
        $this->container['dossierid'] = isset($data['dossierid']) ? $data['dossierid'] : null;
        $this->container['recipientserviceprovider'] = isset($data['recipientserviceprovider']) ? $data['recipientserviceprovider'] : null;
        $this->container['recipientnetworkoperator'] = isset($data['recipientnetworkoperator']) ? $data['recipientnetworkoperator'] : null;
        $this->container['donornetworkoperator'] = isset($data['donornetworkoperator']) ? $data['donornetworkoperator'] : null;
        $this->container['donorserviceprovider'] = isset($data['donorserviceprovider']) ? $data['donorserviceprovider'] : null;
        $this->container['business'] = isset($data['business']) ? $data['business'] : null;
        $this->container['earlytermination'] = isset($data['earlytermination']) ? $data['earlytermination'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['addressblock'] = isset($data['addressblock']) ? $data['addressblock'] : null;
        $this->container['numberseries'] = isset($data['numberseries']) ? $data['numberseries'] : null;
        $this->container['validationblock'] = isset($data['validationblock']) ? $data['validationblock'] : null;
        $this->container['note'] = isset($data['note']) ? $data['note'] : null;
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
        if ((mb_strlen($this->container['dossierid']) > 40)) {
            $invalidProperties[] = "invalid value for 'dossierid', the character length must be smaller than or equal to 40.";
        }

        if ((mb_strlen($this->container['dossierid']) < 8)) {
            $invalidProperties[] = "invalid value for 'dossierid', the character length must be bigger than or equal to 8.";
        }

        if (!preg_match("/^[A-Z0-9]{1,6}-[A-Z0-9]{1,6}-[A-Za-z0-9]{1,22}-[0-9]{1,3}$/", $this->container['dossierid'])) {
            $invalidProperties[] = "invalid value for 'dossierid', must be conform to the pattern /^[A-Z0-9]{1,6}-[A-Z0-9]{1,6}-[A-Za-z0-9]{1,22}-[0-9]{1,3}$/.";
        }

        if ($this->container['recipientserviceprovider'] === null) {
            $invalidProperties[] = "'recipientserviceprovider' can't be null";
        }
        if (!preg_match("/^[0-9A-Z]{3,6}$/", $this->container['recipientserviceprovider'])) {
            $invalidProperties[] = "invalid value for 'recipientserviceprovider', must be conform to the pattern /^[0-9A-Z]{3,6}$/.";
        }

        if (!is_null($this->container['recipientnetworkoperator']) && !preg_match("/^[0-9A-Z]{3,6}$/", $this->container['recipientnetworkoperator'])) {
            $invalidProperties[] = "invalid value for 'recipientnetworkoperator', must be conform to the pattern /^[0-9A-Z]{3,6}$/.";
        }

        if (!is_null($this->container['donornetworkoperator']) && !preg_match("/^[0-9A-Z]{3,6}$/", $this->container['donornetworkoperator'])) {
            $invalidProperties[] = "invalid value for 'donornetworkoperator', must be conform to the pattern /^[0-9A-Z]{3,6}$/.";
        }

        if ($this->container['donorserviceprovider'] === null) {
            $invalidProperties[] = "'donorserviceprovider' can't be null";
        }
        if (!preg_match("/^[0-9A-Z]{3,6}$/", $this->container['donorserviceprovider'])) {
            $invalidProperties[] = "invalid value for 'donorserviceprovider', must be conform to the pattern /^[0-9A-Z]{3,6}$/.";
        }

        if ($this->container['business'] === null) {
            $invalidProperties[] = "'business' can't be null";
        }
        if (!preg_match("/^[YN]$/", $this->container['business'])) {
            $invalidProperties[] = "invalid value for 'business', must be conform to the pattern /^[YN]$/.";
        }

        if ($this->container['earlytermination'] === null) {
            $invalidProperties[] = "'earlytermination' can't be null";
        }
        if (!preg_match("/^[YN]$/", $this->container['earlytermination'])) {
            $invalidProperties[] = "invalid value for 'earlytermination', must be conform to the pattern /^[YN]$/.";
        }

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ((mb_strlen($this->container['name']) > 100)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be smaller than or equal to 100.";
        }

        if ((mb_strlen($this->container['name']) < 1)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['addressblock'] === null) {
            $invalidProperties[] = "'addressblock' can't be null";
        }
        if (!is_null($this->container['note']) && (mb_strlen($this->container['note']) > 100)) {
            $invalidProperties[] = "invalid value for 'note', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['note']) && (mb_strlen($this->container['note']) < 1)) {
            $invalidProperties[] = "invalid value for 'note', the character length must be bigger than or equal to 1.";
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
     * @param string $dossierid The identifier for the Contract Termination Request determined by the Recipient for communication between the Recipient and Donor. Defined as [RecipientSPCode]-[DonorSPCode]-[Identifier] The requirement is that the dossierid is unique and identifies the contract termination request.
     *
     * @return $this
     */
    public function setDossierid($dossierid)
    {
        if ((mb_strlen($dossierid) > 40)) {
            throw new InvalidArgumentException('invalid length for $dossierid when calling ContractTerminationRequest., must be smaller than or equal to 40.');
        }
        if ((mb_strlen($dossierid) < 8)) {
            throw new InvalidArgumentException('invalid length for $dossierid when calling ContractTerminationRequest., must be bigger than or equal to 8.');
        }
        if ((!preg_match("/^[A-Z0-9]{1,6}-[A-Z0-9]{1,6}-[A-Za-z0-9]{1,22}-[0-9]{1,3}$/", $dossierid))) {
            throw new InvalidArgumentException("invalid value for $dossierid when calling ContractTerminationRequest., must conform to the pattern /^[A-Z0-9]{1,6}-[A-Z0-9]{1,6}-[A-Za-z0-9]{1,22}-[0-9]{1,3}$/.");
        }

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
     * @param string $recipientserviceprovider Code of the Recipient party
     *
     * @return $this
     */
    public function setRecipientserviceprovider($recipientserviceprovider)
    {

        if ((!preg_match("/^[0-9A-Z]{3,6}$/", $recipientserviceprovider))) {
            throw new InvalidArgumentException("invalid value for $recipientserviceprovider when calling ContractTerminationRequest., must conform to the pattern /^[0-9A-Z]{3,6}$/.");
        }

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
     * @param string $recipientnetworkoperator Code of the Recipient party
     *
     * @return $this
     */
    public function setRecipientnetworkoperator($recipientnetworkoperator)
    {

        if (!is_null($recipientnetworkoperator) && (!preg_match("/^[0-9A-Z]{3,6}$/", $recipientnetworkoperator))) {
            throw new InvalidArgumentException("invalid value for $recipientnetworkoperator when calling ContractTerminationRequest., must conform to the pattern /^[0-9A-Z]{3,6}$/.");
        }

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
     * @param string $donornetworkoperator Code of the Donor party
     *
     * @return $this
     */
    public function setDonornetworkoperator($donornetworkoperator)
    {

        if (!is_null($donornetworkoperator) && (!preg_match("/^[0-9A-Z]{3,6}$/", $donornetworkoperator))) {
            throw new InvalidArgumentException("invalid value for $donornetworkoperator when calling ContractTerminationRequest., must conform to the pattern /^[0-9A-Z]{3,6}$/.");
        }

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
     * @param string $donorserviceprovider Code of the Donor party
     *
     * @return $this
     */
    public function setDonorserviceprovider($donorserviceprovider)
    {

        if ((!preg_match("/^[0-9A-Z]{3,6}$/", $donorserviceprovider))) {
            throw new InvalidArgumentException("invalid value for $donorserviceprovider when calling ContractTerminationRequest., must conform to the pattern /^[0-9A-Z]{3,6}$/.");
        }

        $this->container['donorserviceprovider'] = $donorserviceprovider;

        return $this;
    }

    /**
     * Gets business
     *
     * @return string
     */
    public function getBusiness()
    {
        return $this->container['business'];
    }

    /**
     * Sets business
     *
     * @param string $business Indicates whether the dossier is a business request or not
     *
     * @return $this
     */
    public function setBusiness($business)
    {

        if ((!preg_match("/^[YN]$/", $business))) {
            throw new InvalidArgumentException("invalid value for $business when calling ContractTerminationRequest., must conform to the pattern /^[YN]$/.");
        }

        $this->container['business'] = $business;

        return $this;
    }

    /**
     * Gets earlytermination
     *
     * @return string
     */
    public function getEarlytermination()
    {
        return $this->container['earlytermination'];
    }

    /**
     * Sets earlytermination
     *
     * @param string $earlytermination Indicates whether there is an authorisation for early termination of contract
     *
     * @return $this
     */
    public function setEarlytermination($earlytermination)
    {

        if ((!preg_match("/^[YN]$/", $earlytermination))) {
            throw new InvalidArgumentException("invalid value for $earlytermination when calling ContractTerminationRequest., must conform to the pattern /^[YN]$/.");
        }

        $this->container['earlytermination'] = $earlytermination;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name Contract name that is requested to be terminated
     *
     * @return $this
     */
    public function setName($name)
    {
        if ((mb_strlen($name) > 100)) {
            throw new InvalidArgumentException('invalid length for $name when calling ContractTerminationRequest., must be smaller than or equal to 100.');
        }
        if ((mb_strlen($name) < 1)) {
            throw new InvalidArgumentException('invalid length for $name when calling ContractTerminationRequest., must be bigger than or equal to 1.');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets addressblock
     *
     * @return AddressBlock
     */
    public function getAddressblock()
    {
        return $this->container['addressblock'];
    }

    /**
     * Sets addressblock
     *
     * @param AddressBlock $addressblock addressblock
     *
     * @return $this
     */
    public function setAddressblock($addressblock)
    {
        $this->container['addressblock'] = $addressblock;

        return $this;
    }

    /**
     * Gets numberseries
     *
     * @return NumberSeries[]
     */
    public function getNumberseries()
    {
        return $this->container['numberseries'];
    }

    /**
     * Sets numberseries
     *
     * @param NumberSeries[] $numberseries numberseries
     *
     * @return $this
     */
    public function setNumberseries($numberseries)
    {
        $this->container['numberseries'] = $numberseries;

        return $this;
    }

    /**
     * Gets validationblock
     *
     * @return ValidationBlock[]
     */
    public function getValidationblock()
    {
        return $this->container['validationblock'];
    }

    /**
     * Sets validationblock
     *
     * @param ValidationBlock[] $validationblock validationblock
     *
     * @return $this
     */
    public function setValidationblock($validationblock)
    {
        $this->container['validationblock'] = $validationblock;

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
     * @param string $note Note field for additional information
     *
     * @return $this
     */
    public function setNote($note)
    {
        if (!is_null($note) && (mb_strlen($note) > 100)) {
            throw new InvalidArgumentException('invalid length for $note when calling ContractTerminationRequest., must be smaller than or equal to 100.');
        }
        if (!is_null($note) && (mb_strlen($note) < 1)) {
            throw new InvalidArgumentException('invalid length for $note when calling ContractTerminationRequest., must be bigger than or equal to 1.');
        }

        $this->container['note'] = $note;

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


