<?php
/**
 * GetUniverseBloodlines200Ok
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
 * GetUniverseBloodlines200Ok Class Doc Comment
 *
 * @category    Class */
 // @description 200 ok object
/**
 * @package     nullx27\ESI
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class GetUniverseBloodlines200Ok implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'get_universe_bloodlines_200_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'bloodlineId' => 'int',
        'charisma' => 'int',
        'corporationId' => 'int',
        'description' => 'string',
        'intelligence' => 'int',
        'memory' => 'int',
        'name' => 'string',
        'perception' => 'int',
        'raceId' => 'int',
        'shipTypeId' => 'int',
        'willpower' => 'int'
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
        'bloodlineId' => 'bloodline_id',
        'charisma' => 'charisma',
        'corporationId' => 'corporation_id',
        'description' => 'description',
        'intelligence' => 'intelligence',
        'memory' => 'memory',
        'name' => 'name',
        'perception' => 'perception',
        'raceId' => 'race_id',
        'shipTypeId' => 'ship_type_id',
        'willpower' => 'willpower'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'bloodlineId' => 'setBloodlineId',
        'charisma' => 'setCharisma',
        'corporationId' => 'setCorporationId',
        'description' => 'setDescription',
        'intelligence' => 'setIntelligence',
        'memory' => 'setMemory',
        'name' => 'setName',
        'perception' => 'setPerception',
        'raceId' => 'setRaceId',
        'shipTypeId' => 'setShipTypeId',
        'willpower' => 'setWillpower'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'bloodlineId' => 'getBloodlineId',
        'charisma' => 'getCharisma',
        'corporationId' => 'getCorporationId',
        'description' => 'getDescription',
        'intelligence' => 'getIntelligence',
        'memory' => 'getMemory',
        'name' => 'getName',
        'perception' => 'getPerception',
        'raceId' => 'getRaceId',
        'shipTypeId' => 'getShipTypeId',
        'willpower' => 'getWillpower'
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
        $this->container['bloodlineId'] = isset($data['bloodlineId']) ? $data['bloodlineId'] : null;
        $this->container['charisma'] = isset($data['charisma']) ? $data['charisma'] : null;
        $this->container['corporationId'] = isset($data['corporationId']) ? $data['corporationId'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['intelligence'] = isset($data['intelligence']) ? $data['intelligence'] : null;
        $this->container['memory'] = isset($data['memory']) ? $data['memory'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['perception'] = isset($data['perception']) ? $data['perception'] : null;
        $this->container['raceId'] = isset($data['raceId']) ? $data['raceId'] : null;
        $this->container['shipTypeId'] = isset($data['shipTypeId']) ? $data['shipTypeId'] : null;
        $this->container['willpower'] = isset($data['willpower']) ? $data['willpower'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        if ($this->container['bloodlineId'] === null) {
            $invalid_properties[] = "'bloodlineId' can't be null";
        }
        if ($this->container['charisma'] === null) {
            $invalid_properties[] = "'charisma' can't be null";
        }
        if ($this->container['corporationId'] === null) {
            $invalid_properties[] = "'corporationId' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalid_properties[] = "'description' can't be null";
        }
        if ($this->container['intelligence'] === null) {
            $invalid_properties[] = "'intelligence' can't be null";
        }
        if ($this->container['memory'] === null) {
            $invalid_properties[] = "'memory' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalid_properties[] = "'name' can't be null";
        }
        if ($this->container['perception'] === null) {
            $invalid_properties[] = "'perception' can't be null";
        }
        if ($this->container['raceId'] === null) {
            $invalid_properties[] = "'raceId' can't be null";
        }
        if ($this->container['shipTypeId'] === null) {
            $invalid_properties[] = "'shipTypeId' can't be null";
        }
        if ($this->container['willpower'] === null) {
            $invalid_properties[] = "'willpower' can't be null";
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
        if ($this->container['bloodlineId'] === null) {
            return false;
        }
        if ($this->container['charisma'] === null) {
            return false;
        }
        if ($this->container['corporationId'] === null) {
            return false;
        }
        if ($this->container['description'] === null) {
            return false;
        }
        if ($this->container['intelligence'] === null) {
            return false;
        }
        if ($this->container['memory'] === null) {
            return false;
        }
        if ($this->container['name'] === null) {
            return false;
        }
        if ($this->container['perception'] === null) {
            return false;
        }
        if ($this->container['raceId'] === null) {
            return false;
        }
        if ($this->container['shipTypeId'] === null) {
            return false;
        }
        if ($this->container['willpower'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets bloodlineId
     * @return int
     */
    public function getBloodlineId()
    {
        return $this->container['bloodlineId'];
    }

    /**
     * Sets bloodlineId
     * @param int $bloodlineId bloodline_id integer
     * @return $this
     */
    public function setBloodlineId($bloodlineId)
    {
        $this->container['bloodlineId'] = $bloodlineId;

        return $this;
    }

    /**
     * Gets charisma
     * @return int
     */
    public function getCharisma()
    {
        return $this->container['charisma'];
    }

    /**
     * Sets charisma
     * @param int $charisma charisma integer
     * @return $this
     */
    public function setCharisma($charisma)
    {
        $this->container['charisma'] = $charisma;

        return $this;
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
     * Gets intelligence
     * @return int
     */
    public function getIntelligence()
    {
        return $this->container['intelligence'];
    }

    /**
     * Sets intelligence
     * @param int $intelligence intelligence integer
     * @return $this
     */
    public function setIntelligence($intelligence)
    {
        $this->container['intelligence'] = $intelligence;

        return $this;
    }

    /**
     * Gets memory
     * @return int
     */
    public function getMemory()
    {
        return $this->container['memory'];
    }

    /**
     * Sets memory
     * @param int $memory memory integer
     * @return $this
     */
    public function setMemory($memory)
    {
        $this->container['memory'] = $memory;

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
     * Gets perception
     * @return int
     */
    public function getPerception()
    {
        return $this->container['perception'];
    }

    /**
     * Sets perception
     * @param int $perception perception integer
     * @return $this
     */
    public function setPerception($perception)
    {
        $this->container['perception'] = $perception;

        return $this;
    }

    /**
     * Gets raceId
     * @return int
     */
    public function getRaceId()
    {
        return $this->container['raceId'];
    }

    /**
     * Sets raceId
     * @param int $raceId race_id integer
     * @return $this
     */
    public function setRaceId($raceId)
    {
        $this->container['raceId'] = $raceId;

        return $this;
    }

    /**
     * Gets shipTypeId
     * @return int
     */
    public function getShipTypeId()
    {
        return $this->container['shipTypeId'];
    }

    /**
     * Sets shipTypeId
     * @param int $shipTypeId ship_type_id integer
     * @return $this
     */
    public function setShipTypeId($shipTypeId)
    {
        $this->container['shipTypeId'] = $shipTypeId;

        return $this;
    }

    /**
     * Gets willpower
     * @return int
     */
    public function getWillpower()
    {
        return $this->container['willpower'];
    }

    /**
     * Sets willpower
     * @param int $willpower willpower integer
     * @return $this
     */
    public function setWillpower($willpower)
    {
        $this->container['willpower'] = $willpower;

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


