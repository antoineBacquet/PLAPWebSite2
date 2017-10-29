<?php
/**
 * GetUniverseFactions200Ok
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
 * OpenAPI spec version: 0.4.2.dev16
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
 * GetUniverseFactions200Ok Class Doc Comment
 *
 * @category    Class */
 // @description 200 ok object
/**
 * @package     nullx27\ESI
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class GetUniverseFactions200Ok implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'get_universe_factions_200_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'corporationId' => 'int',
        'description' => 'string',
        'factionId' => 'int',
        'isUnique' => 'bool',
        'militiaCorporationId' => 'int',
        'name' => 'string',
        'sizeFactor' => 'float',
        'solarSystemId' => 'int',
        'stationCount' => 'int',
        'stationSystemCount' => 'int'
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
        'corporationId' => 'corporation_id',
        'description' => 'description',
        'factionId' => 'faction_id',
        'isUnique' => 'is_unique',
        'militiaCorporationId' => 'militia_corporation_id',
        'name' => 'name',
        'sizeFactor' => 'size_factor',
        'solarSystemId' => 'solar_system_id',
        'stationCount' => 'station_count',
        'stationSystemCount' => 'station_system_count'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'corporationId' => 'setCorporationId',
        'description' => 'setDescription',
        'factionId' => 'setFactionId',
        'isUnique' => 'setIsUnique',
        'militiaCorporationId' => 'setMilitiaCorporationId',
        'name' => 'setName',
        'sizeFactor' => 'setSizeFactor',
        'solarSystemId' => 'setSolarSystemId',
        'stationCount' => 'setStationCount',
        'stationSystemCount' => 'setStationSystemCount'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'corporationId' => 'getCorporationId',
        'description' => 'getDescription',
        'factionId' => 'getFactionId',
        'isUnique' => 'getIsUnique',
        'militiaCorporationId' => 'getMilitiaCorporationId',
        'name' => 'getName',
        'sizeFactor' => 'getSizeFactor',
        'solarSystemId' => 'getSolarSystemId',
        'stationCount' => 'getStationCount',
        'stationSystemCount' => 'getStationSystemCount'
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
        $this->container['corporationId'] = isset($data['corporationId']) ? $data['corporationId'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['factionId'] = isset($data['factionId']) ? $data['factionId'] : null;
        $this->container['isUnique'] = isset($data['isUnique']) ? $data['isUnique'] : null;
        $this->container['militiaCorporationId'] = isset($data['militiaCorporationId']) ? $data['militiaCorporationId'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['sizeFactor'] = isset($data['sizeFactor']) ? $data['sizeFactor'] : null;
        $this->container['solarSystemId'] = isset($data['solarSystemId']) ? $data['solarSystemId'] : null;
        $this->container['stationCount'] = isset($data['stationCount']) ? $data['stationCount'] : null;
        $this->container['stationSystemCount'] = isset($data['stationSystemCount']) ? $data['stationSystemCount'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        if ($this->container['corporationId'] === null) {
            $invalid_properties[] = "'corporationId' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalid_properties[] = "'description' can't be null";
        }
        if ($this->container['factionId'] === null) {
            $invalid_properties[] = "'factionId' can't be null";
        }
        if ($this->container['isUnique'] === null) {
            $invalid_properties[] = "'isUnique' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalid_properties[] = "'name' can't be null";
        }
        if ($this->container['sizeFactor'] === null) {
            $invalid_properties[] = "'sizeFactor' can't be null";
        }
        if ($this->container['solarSystemId'] === null) {
            $invalid_properties[] = "'solarSystemId' can't be null";
        }
        if ($this->container['stationCount'] === null) {
            $invalid_properties[] = "'stationCount' can't be null";
        }
        if ($this->container['stationSystemCount'] === null) {
            $invalid_properties[] = "'stationSystemCount' can't be null";
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
        if ($this->container['corporationId'] === null) {
            return false;
        }
        if ($this->container['description'] === null) {
            return false;
        }
        if ($this->container['factionId'] === null) {
            return false;
        }
        if ($this->container['isUnique'] === null) {
            return false;
        }
        if ($this->container['name'] === null) {
            return false;
        }
        if ($this->container['sizeFactor'] === null) {
            return false;
        }
        if ($this->container['solarSystemId'] === null) {
            return false;
        }
        if ($this->container['stationCount'] === null) {
            return false;
        }
        if ($this->container['stationSystemCount'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets corporationId
     * @return int
     */
    public function getCorporationId()
    {
        return $this->container['corporationId'];
    }

    /**
     * Sets corporationId
     * @param int $corporationId corporation_id integer
     * @return $this
     */
    public function setCorporationId($corporationId)
    {
        $this->container['corporationId'] = $corporationId;

        return $this;
    }

    /**
     * Gets description
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     * @param string $description description string
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets factionId
     * @return int
     */
    public function getFactionId()
    {
        return $this->container['factionId'];
    }

    /**
     * Sets factionId
     * @param int $factionId faction_id integer
     * @return $this
     */
    public function setFactionId($factionId)
    {
        $this->container['factionId'] = $factionId;

        return $this;
    }

    /**
     * Gets isUnique
     * @return bool
     */
    public function getIsUnique()
    {
        return $this->container['isUnique'];
    }

    /**
     * Sets isUnique
     * @param bool $isUnique is_unique boolean
     * @return $this
     */
    public function setIsUnique($isUnique)
    {
        $this->container['isUnique'] = $isUnique;

        return $this;
    }

    /**
     * Gets militiaCorporationId
     * @return int
     */
    public function getMilitiaCorporationId()
    {
        return $this->container['militiaCorporationId'];
    }

    /**
     * Sets militiaCorporationId
     * @param int $militiaCorporationId militia_corporation_id integer
     * @return $this
     */
    public function setMilitiaCorporationId($militiaCorporationId)
    {
        $this->container['militiaCorporationId'] = $militiaCorporationId;

        return $this;
    }

    /**
     * Gets name
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     * @param string $name name string
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets sizeFactor
     * @return float
     */
    public function getSizeFactor()
    {
        return $this->container['sizeFactor'];
    }

    /**
     * Sets sizeFactor
     * @param float $sizeFactor size_factor number
     * @return $this
     */
    public function setSizeFactor($sizeFactor)
    {
        $this->container['sizeFactor'] = $sizeFactor;

        return $this;
    }

    /**
     * Gets solarSystemId
     * @return int
     */
    public function getSolarSystemId()
    {
        return $this->container['solarSystemId'];
    }

    /**
     * Sets solarSystemId
     * @param int $solarSystemId solar_system_id integer
     * @return $this
     */
    public function setSolarSystemId($solarSystemId)
    {
        $this->container['solarSystemId'] = $solarSystemId;

        return $this;
    }

    /**
     * Gets stationCount
     * @return int
     */
    public function getStationCount()
    {
        return $this->container['stationCount'];
    }

    /**
     * Sets stationCount
     * @param int $stationCount station_count integer
     * @return $this
     */
    public function setStationCount($stationCount)
    {
        $this->container['stationCount'] = $stationCount;

        return $this;
    }

    /**
     * Gets stationSystemCount
     * @return int
     */
    public function getStationSystemCount()
    {
        return $this->container['stationSystemCount'];
    }

    /**
     * Sets stationSystemCount
     * @param int $stationSystemCount station_system_count integer
     * @return $this
     */
    public function setStationSystemCount($stationSystemCount)
    {
        $this->container['stationSystemCount'] = $stationSystemCount;

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


