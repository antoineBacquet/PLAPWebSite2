<?php
/**
 * GetCharactersCharacterIdContractsContractIdBids200Ok
 *
 * PHP version 5
 *
 * @category Class
 * @package  nullx27\ESI
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * EVE Swagger Interface
 *
 * An OpenAPI for EVE Online
 *
 * OpenAPI spec version: 0.7.3
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.3.1-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace nullx27\ESI\nullx27\ESI\Models;

use \ArrayAccess;
use \nullx27\ESI\ObjectSerializer;

/**
 * GetCharactersCharacterIdContractsContractIdBids200Ok Class Doc Comment
 *
 * @category Class
 * @description 200 ok object
 * @package  nullx27\ESI
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class GetCharactersCharacterIdContractsContractIdBids200Ok implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'get_characters_character_id_contracts_contract_id_bids_200_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'bidId' => 'int',
        'bidderId' => 'int',
        'dateBid' => '\DateTime',
        'amount' => 'float'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'bidId' => 'int32',
        'bidderId' => 'int32',
        'dateBid' => 'date-time',
        'amount' => 'float'
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
        'bidId' => 'bid_id',
        'bidderId' => 'bidder_id',
        'dateBid' => 'date_bid',
        'amount' => 'amount'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'bidId' => 'setBidId',
        'bidderId' => 'setBidderId',
        'dateBid' => 'setDateBid',
        'amount' => 'setAmount'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'bidId' => 'getBidId',
        'bidderId' => 'getBidderId',
        'dateBid' => 'getDateBid',
        'amount' => 'getAmount'
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
        $this->container['bidId'] = isset($data['bidId']) ? $data['bidId'] : null;
        $this->container['bidderId'] = isset($data['bidderId']) ? $data['bidderId'] : null;
        $this->container['dateBid'] = isset($data['dateBid']) ? $data['dateBid'] : null;
        $this->container['amount'] = isset($data['amount']) ? $data['amount'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['bidId'] === null) {
            $invalidProperties[] = "'bidId' can't be null";
        }
        if ($this->container['bidderId'] === null) {
            $invalidProperties[] = "'bidderId' can't be null";
        }
        if ($this->container['dateBid'] === null) {
            $invalidProperties[] = "'dateBid' can't be null";
        }
        if ($this->container['amount'] === null) {
            $invalidProperties[] = "'amount' can't be null";
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

        if ($this->container['bidId'] === null) {
            return false;
        }
        if ($this->container['bidderId'] === null) {
            return false;
        }
        if ($this->container['dateBid'] === null) {
            return false;
        }
        if ($this->container['amount'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets bidId
     *
     * @return int
     */
    public function getBidId()
    {
        return $this->container['bidId'];
    }

    /**
     * Sets bidId
     *
     * @param int $bidId Unique ID for the bid
     *
     * @return $this
     */
    public function setBidId($bidId)
    {
        $this->container['bidId'] = $bidId;

        return $this;
    }

    /**
     * Gets bidderId
     *
     * @return int
     */
    public function getBidderId()
    {
        return $this->container['bidderId'];
    }

    /**
     * Sets bidderId
     *
     * @param int $bidderId Character ID of the bidder
     *
     * @return $this
     */
    public function setBidderId($bidderId)
    {
        $this->container['bidderId'] = $bidderId;

        return $this;
    }

    /**
     * Gets dateBid
     *
     * @return \DateTime
     */
    public function getDateBid()
    {
        return $this->container['dateBid'];
    }

    /**
     * Sets dateBid
     *
     * @param \DateTime $dateBid Datetime when the bid was placed
     *
     * @return $this
     */
    public function setDateBid($dateBid)
    {
        $this->container['dateBid'] = $dateBid;

        return $this;
    }

    /**
     * Gets amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param float $amount The amount bid, in ISK
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

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


