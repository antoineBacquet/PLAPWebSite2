<?php
/**
 * GetCharactersCharacterIdPlanetsPlanetIdPin
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
 * GetCharactersCharacterIdPlanetsPlanetIdPin Class Doc Comment
 *
 * @category    Class */
 // @description pin object
/**
 * @package     nullx27\ESI
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class GetCharactersCharacterIdPlanetsPlanetIdPin implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'get_characters_character_id_planets_planet_id_pin';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'expiryTime' => '\DateTime',
        'extractorDetails' => '\nullx27\ESI\Models\GetCharactersCharacterIdPlanetsPlanetIdExtractorDetails',
        'factoryDetails' => '\nullx27\ESI\Models\GetCharactersCharacterIdPlanetsPlanetIdFactoryDetails',
        'installTime' => '\DateTime',
        'lastCycleStart' => '\DateTime',
        'latitude' => 'float',
        'longitude' => 'float',
        'pinId' => 'int',
        'schematicId' => 'int',
        'typeId' => 'int'
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
        'expiryTime' => 'expiry_time',
        'extractorDetails' => 'extractor_details',
        'factoryDetails' => 'factory_details',
        'installTime' => 'install_time',
        'lastCycleStart' => 'last_cycle_start',
        'latitude' => 'latitude',
        'longitude' => 'longitude',
        'pinId' => 'pin_id',
        'schematicId' => 'schematic_id',
        'typeId' => 'type_id'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'expiryTime' => 'setExpiryTime',
        'extractorDetails' => 'setExtractorDetails',
        'factoryDetails' => 'setFactoryDetails',
        'installTime' => 'setInstallTime',
        'lastCycleStart' => 'setLastCycleStart',
        'latitude' => 'setLatitude',
        'longitude' => 'setLongitude',
        'pinId' => 'setPinId',
        'schematicId' => 'setSchematicId',
        'typeId' => 'setTypeId'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'expiryTime' => 'getExpiryTime',
        'extractorDetails' => 'getExtractorDetails',
        'factoryDetails' => 'getFactoryDetails',
        'installTime' => 'getInstallTime',
        'lastCycleStart' => 'getLastCycleStart',
        'latitude' => 'getLatitude',
        'longitude' => 'getLongitude',
        'pinId' => 'getPinId',
        'schematicId' => 'getSchematicId',
        'typeId' => 'getTypeId'
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
        $this->container['expiryTime'] = isset($data['expiryTime']) ? $data['expiryTime'] : null;
        $this->container['extractorDetails'] = isset($data['extractorDetails']) ? $data['extractorDetails'] : null;
        $this->container['factoryDetails'] = isset($data['factoryDetails']) ? $data['factoryDetails'] : null;
        $this->container['installTime'] = isset($data['installTime']) ? $data['installTime'] : null;
        $this->container['lastCycleStart'] = isset($data['lastCycleStart']) ? $data['lastCycleStart'] : null;
        $this->container['latitude'] = isset($data['latitude']) ? $data['latitude'] : null;
        $this->container['longitude'] = isset($data['longitude']) ? $data['longitude'] : null;
        $this->container['pinId'] = isset($data['pinId']) ? $data['pinId'] : null;
        $this->container['schematicId'] = isset($data['schematicId']) ? $data['schematicId'] : null;
        $this->container['typeId'] = isset($data['typeId']) ? $data['typeId'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        if ($this->container['latitude'] === null) {
            $invalid_properties[] = "'latitude' can't be null";
        }
        if ($this->container['longitude'] === null) {
            $invalid_properties[] = "'longitude' can't be null";
        }
        if ($this->container['pinId'] === null) {
            $invalid_properties[] = "'pinId' can't be null";
        }
        if ($this->container['typeId'] === null) {
            $invalid_properties[] = "'typeId' can't be null";
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
        if ($this->container['latitude'] === null) {
            return false;
        }
        if ($this->container['longitude'] === null) {
            return false;
        }
        if ($this->container['pinId'] === null) {
            return false;
        }
        if ($this->container['typeId'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets expiryTime
     * @return \DateTime
     */
    public function getExpiryTime()
    {
        return $this->container['expiryTime'];
    }

    /**
     * Sets expiryTime
     * @param \DateTime $expiryTime expiry_time string
     * @return $this
     */
    public function setExpiryTime($expiryTime)
    {
        $this->container['expiryTime'] = $expiryTime;

        return $this;
    }

    /**
     * Gets extractorDetails
     * @return \nullx27\ESI\Models\GetCharactersCharacterIdPlanetsPlanetIdExtractorDetails
     */
    public function getExtractorDetails()
    {
        return $this->container['extractorDetails'];
    }

    /**
     * Sets extractorDetails
     * @param \nullx27\ESI\Models\GetCharactersCharacterIdPlanetsPlanetIdExtractorDetails $extractorDetails
     * @return $this
     */
    public function setExtractorDetails($extractorDetails)
    {
        $this->container['extractorDetails'] = $extractorDetails;

        return $this;
    }

    /**
     * Gets factoryDetails
     * @return \nullx27\ESI\Models\GetCharactersCharacterIdPlanetsPlanetIdFactoryDetails
     */
    public function getFactoryDetails()
    {
        return $this->container['factoryDetails'];
    }

    /**
     * Sets factoryDetails
     * @param \nullx27\ESI\Models\GetCharactersCharacterIdPlanetsPlanetIdFactoryDetails $factoryDetails
     * @return $this
     */
    public function setFactoryDetails($factoryDetails)
    {
        $this->container['factoryDetails'] = $factoryDetails;

        return $this;
    }

    /**
     * Gets installTime
     * @return \DateTime
     */
    public function getInstallTime()
    {
        return $this->container['installTime'];
    }

    /**
     * Sets installTime
     * @param \DateTime $installTime install_time string
     * @return $this
     */
    public function setInstallTime($installTime)
    {
        $this->container['installTime'] = $installTime;

        return $this;
    }

    /**
     * Gets lastCycleStart
     * @return \DateTime
     */
    public function getLastCycleStart()
    {
        return $this->container['lastCycleStart'];
    }

    /**
     * Sets lastCycleStart
     * @param \DateTime $lastCycleStart last_cycle_start string
     * @return $this
     */
    public function setLastCycleStart($lastCycleStart)
    {
        $this->container['lastCycleStart'] = $lastCycleStart;

        return $this;
    }

    /**
     * Gets latitude
     * @return float
     */
    public function getLatitude()
    {
        return $this->container['latitude'];
    }

    /**
     * Sets latitude
     * @param float $latitude latitude number
     * @return $this
     */
    public function setLatitude($latitude)
    {
        $this->container['latitude'] = $latitude;

        return $this;
    }

    /**
     * Gets longitude
     * @return float
     */
    public function getLongitude()
    {
        return $this->container['longitude'];
    }

    /**
     * Sets longitude
     * @param float $longitude longitude number
     * @return $this
     */
    public function setLongitude($longitude)
    {
        $this->container['longitude'] = $longitude;

        return $this;
    }

    /**
     * Gets pinId
     * @return int
     */
    public function getPinId()
    {
        return $this->container['pinId'];
    }

    /**
     * Sets pinId
     * @param int $pinId pin_id integer
     * @return $this
     */
    public function setPinId($pinId)
    {
        $this->container['pinId'] = $pinId;

        return $this;
    }

    /**
     * Gets schematicId
     * @return int
     */
    public function getSchematicId()
    {
        return $this->container['schematicId'];
    }

    /**
     * Sets schematicId
     * @param int $schematicId schematic_id integer
     * @return $this
     */
    public function setSchematicId($schematicId)
    {
        $this->container['schematicId'] = $schematicId;

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

