<?php
/**
 * GetMarketsRegionIdOrders200Ok
 *
 * PHP version 5
 *
 * @category Class
 * @package  nullx27\ESI
 * @author   Swaagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * EVE Swagger Interface
 *
 * An OpenAPI for EVE Online
 *
 * OpenAPI spec version: 0.4.9.dev1
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace nullx27\ESI\Models;

use \ArrayAccess;

/**
 * GetMarketsRegionIdOrders200Ok Class Doc Comment
 *
 * @category    Class */
 // @description 200 ok object
/**
 * @package     nullx27\ESI
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class GetMarketsRegionIdOrders200Ok implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'get_markets_region_id_orders_200_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'duration' => 'int',
        'isBuyOrder' => 'bool',
        'issued' => '\DateTime',
        'locationId' => 'int',
        'minVolume' => 'int',
        'orderId' => 'int',
        'price' => 'float',
        'range' => 'string',
        'typeId' => 'int',
        'volumeRemain' => 'int',
        'volumeTotal' => 'int'
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'duration' => 'duration',
        'isBuyOrder' => 'is_buy_order',
        'issued' => 'issued',
        'locationId' => 'location_id',
        'minVolume' => 'min_volume',
        'orderId' => 'order_id',
        'price' => 'price',
        'range' => 'range',
        'typeId' => 'type_id',
        'volumeRemain' => 'volume_remain',
        'volumeTotal' => 'volume_total'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'duration' => 'setDuration',
        'isBuyOrder' => 'setIsBuyOrder',
        'issued' => 'setIssued',
        'locationId' => 'setLocationId',
        'minVolume' => 'setMinVolume',
        'orderId' => 'setOrderId',
        'price' => 'setPrice',
        'range' => 'setRange',
        'typeId' => 'setTypeId',
        'volumeRemain' => 'setVolumeRemain',
        'volumeTotal' => 'setVolumeTotal'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'duration' => 'getDuration',
        'isBuyOrder' => 'getIsBuyOrder',
        'issued' => 'getIssued',
        'locationId' => 'getLocationId',
        'minVolume' => 'getMinVolume',
        'orderId' => 'getOrderId',
        'price' => 'getPrice',
        'range' => 'getRange',
        'typeId' => 'getTypeId',
        'volumeRemain' => 'getVolumeRemain',
        'volumeTotal' => 'getVolumeTotal'
    ];

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    public static function setters()
    {
        return self::$setters;
    }

    public static function getters()
    {
        return self::$getters;
    }

    const RANGE_STATION = 'station';
    const RANGE_REGION = 'region';
    const RANGE_SOLARSYSTEM = 'solarsystem';
    const RANGE__1 = '1';
    const RANGE__2 = '2';
    const RANGE__3 = '3';
    const RANGE__4 = '4';
    const RANGE__5 = '5';
    const RANGE__10 = '10';
    const RANGE__20 = '20';
    const RANGE__30 = '30';
    const RANGE__40 = '40';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getRangeAllowableValues()
    {
        return [
            self::RANGE_STATION,
            self::RANGE_REGION,
            self::RANGE_SOLARSYSTEM,
            self::RANGE__1,
            self::RANGE__2,
            self::RANGE__3,
            self::RANGE__4,
            self::RANGE__5,
            self::RANGE__10,
            self::RANGE__20,
            self::RANGE__30,
            self::RANGE__40,
        ];
    }
    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['duration'] = isset($data['duration']) ? $data['duration'] : null;
        $this->container['isBuyOrder'] = isset($data['isBuyOrder']) ? $data['isBuyOrder'] : null;
        $this->container['issued'] = isset($data['issued']) ? $data['issued'] : null;
        $this->container['locationId'] = isset($data['locationId']) ? $data['locationId'] : null;
        $this->container['minVolume'] = isset($data['minVolume']) ? $data['minVolume'] : null;
        $this->container['orderId'] = isset($data['orderId']) ? $data['orderId'] : null;
        $this->container['price'] = isset($data['price']) ? $data['price'] : null;
        $this->container['range'] = isset($data['range']) ? $data['range'] : null;
        $this->container['typeId'] = isset($data['typeId']) ? $data['typeId'] : null;
        $this->container['volumeRemain'] = isset($data['volumeRemain']) ? $data['volumeRemain'] : null;
        $this->container['volumeTotal'] = isset($data['volumeTotal']) ? $data['volumeTotal'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        if ($this->container['duration'] === null) {
            $invalid_properties[] = "'duration' can't be null";
        }
        if ($this->container['isBuyOrder'] === null) {
            $invalid_properties[] = "'isBuyOrder' can't be null";
        }
        if ($this->container['issued'] === null) {
            $invalid_properties[] = "'issued' can't be null";
        }
        if ($this->container['locationId'] === null) {
            $invalid_properties[] = "'locationId' can't be null";
        }
        if ($this->container['minVolume'] === null) {
            $invalid_properties[] = "'minVolume' can't be null";
        }
        if ($this->container['orderId'] === null) {
            $invalid_properties[] = "'orderId' can't be null";
        }
        if ($this->container['price'] === null) {
            $invalid_properties[] = "'price' can't be null";
        }
        if ($this->container['range'] === null) {
            $invalid_properties[] = "'range' can't be null";
        }
        $allowed_values = ["station", "region", "solarsystem", "1", "2", "3", "4", "5", "10", "20", "30", "40"];
        if (!in_array($this->container['range'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'range', must be one of #{allowed_values}.";
        }

        if ($this->container['typeId'] === null) {
            $invalid_properties[] = "'typeId' can't be null";
        }
        if ($this->container['volumeRemain'] === null) {
            $invalid_properties[] = "'volumeRemain' can't be null";
        }
        if ($this->container['volumeTotal'] === null) {
            $invalid_properties[] = "'volumeTotal' can't be null";
        }
        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properteis are valid
     */
    public function valid()
    {
        if ($this->container['duration'] === null) {
            return false;
        }
        if ($this->container['isBuyOrder'] === null) {
            return false;
        }
        if ($this->container['issued'] === null) {
            return false;
        }
        if ($this->container['locationId'] === null) {
            return false;
        }
        if ($this->container['minVolume'] === null) {
            return false;
        }
        if ($this->container['orderId'] === null) {
            return false;
        }
        if ($this->container['price'] === null) {
            return false;
        }
        if ($this->container['range'] === null) {
            return false;
        }
        $allowed_values = ["station", "region", "solarsystem", "1", "2", "3", "4", "5", "10", "20", "30", "40"];
        if (!in_array($this->container['range'], $allowed_values)) {
            return false;
        }
        if ($this->container['typeId'] === null) {
            return false;
        }
        if ($this->container['volumeRemain'] === null) {
            return false;
        }
        if ($this->container['volumeTotal'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets duration
     * @return int
     */
    public function getDuration()
    {
        return $this->container['duration'];
    }

    /**
     * Sets duration
     * @param int $duration duration integer
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->container['duration'] = $duration;

        return $this;
    }

    /**
     * Gets isBuyOrder
     * @return bool
     */
    public function getIsBuyOrder()
    {
        return $this->container['isBuyOrder'];
    }

    /**
     * Sets isBuyOrder
     * @param bool $isBuyOrder is_buy_order boolean
     * @return $this
     */
    public function setIsBuyOrder($isBuyOrder)
    {
        $this->container['isBuyOrder'] = $isBuyOrder;

        return $this;
    }

    /**
     * Gets issued
     * @return \DateTime
     */
    public function getIssued()
    {
        return $this->container['issued'];
    }

    /**
     * Sets issued
     * @param \DateTime $issued issued string
     * @return $this
     */
    public function setIssued($issued)
    {
        $this->container['issued'] = $issued;

        return $this;
    }

    /**
     * Gets locationId
     * @return int
     */
    public function getLocationId()
    {
        return $this->container['locationId'];
    }

    /**
     * Sets locationId
     * @param int $locationId location_id integer
     * @return $this
     */
    public function setLocationId($locationId)
    {
        $this->container['locationId'] = $locationId;

        return $this;
    }

    /**
     * Gets minVolume
     * @return int
     */
    public function getMinVolume()
    {
        return $this->container['minVolume'];
    }

    /**
     * Sets minVolume
     * @param int $minVolume min_volume integer
     * @return $this
     */
    public function setMinVolume($minVolume)
    {
        $this->container['minVolume'] = $minVolume;

        return $this;
    }

    /**
     * Gets orderId
     * @return int
     */
    public function getOrderId()
    {
        return $this->container['orderId'];
    }

    /**
     * Sets orderId
     * @param int $orderId order_id integer
     * @return $this
     */
    public function setOrderId($orderId)
    {
        $this->container['orderId'] = $orderId;

        return $this;
    }

    /**
     * Gets price
     * @return float
     */
    public function getPrice()
    {
        return $this->container['price'];
    }

    /**
     * Sets price
     * @param float $price price number
     * @return $this
     */
    public function setPrice($price)
    {
        $this->container['price'] = $price;

        return $this;
    }

    /**
     * Gets range
     * @return string
     */
    public function getRange()
    {
        return $this->container['range'];
    }

    /**
     * Sets range
     * @param string $range range string
     * @return $this
     */
    public function setRange($range)
    {
        $allowed_values = array('station', 'region', 'solarsystem', '1', '2', '3', '4', '5', '10', '20', '30', '40');
        if ((!in_array($range, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'range', must be one of 'station', 'region', 'solarsystem', '1', '2', '3', '4', '5', '10', '20', '30', '40'");
        }
        $this->container['range'] = $range;

        return $this;
    }

    /**
     * Gets typeId
     * @return int
     */
    public function getTypeId()
    {
        return $this->container['typeId'];
    }

    /**
     * Sets typeId
     * @param int $typeId type_id integer
     * @return $this
     */
    public function setTypeId($typeId)
    {
        $this->container['typeId'] = $typeId;

        return $this;
    }

    /**
     * Gets volumeRemain
     * @return int
     */
    public function getVolumeRemain()
    {
        return $this->container['volumeRemain'];
    }

    /**
     * Sets volumeRemain
     * @param int $volumeRemain volume_remain integer
     * @return $this
     */
    public function setVolumeRemain($volumeRemain)
    {
        $this->container['volumeRemain'] = $volumeRemain;

        return $this;
    }

    /**
     * Gets volumeTotal
     * @return int
     */
    public function getVolumeTotal()
    {
        return $this->container['volumeTotal'];
    }

    /**
     * Sets volumeTotal
     * @param int $volumeTotal volume_total integer
     * @return $this
     */
    public function setVolumeTotal($volumeTotal)
    {
        $this->container['volumeTotal'] = $volumeTotal;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
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
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\nullx27\ESI\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\nullx27\ESI\ObjectSerializer::sanitizeForSerialization($this));
    }
}


