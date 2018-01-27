<?php
/**
 * GetCharactersCharacterIdAgentsResearch200Ok
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
 * GetCharactersCharacterIdAgentsResearch200Ok Class Doc Comment
 *
 * @category    Class */
 // @description 200 ok object
/**
 * @package     nullx27\ESI
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class GetCharactersCharacterIdAgentsResearch200Ok implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'get_characters_character_id_agents_research_200_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'agentId' => 'int',
        'pointsPerDay' => 'float',
        'remainderPoints' => 'float',
        'skillTypeId' => 'int',
        'startedAt' => '\DateTime'
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
        'agentId' => 'agent_id',
        'pointsPerDay' => 'points_per_day',
        'remainderPoints' => 'remainder_points',
        'skillTypeId' => 'skill_type_id',
        'startedAt' => 'started_at'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'agentId' => 'setAgentId',
        'pointsPerDay' => 'setPointsPerDay',
        'remainderPoints' => 'setRemainderPoints',
        'skillTypeId' => 'setSkillTypeId',
        'startedAt' => 'setStartedAt'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'agentId' => 'getAgentId',
        'pointsPerDay' => 'getPointsPerDay',
        'remainderPoints' => 'getRemainderPoints',
        'skillTypeId' => 'getSkillTypeId',
        'startedAt' => 'getStartedAt'
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
        $this->container['agentId'] = isset($data['agentId']) ? $data['agentId'] : null;
        $this->container['pointsPerDay'] = isset($data['pointsPerDay']) ? $data['pointsPerDay'] : null;
        $this->container['remainderPoints'] = isset($data['remainderPoints']) ? $data['remainderPoints'] : null;
        $this->container['skillTypeId'] = isset($data['skillTypeId']) ? $data['skillTypeId'] : null;
        $this->container['startedAt'] = isset($data['startedAt']) ? $data['startedAt'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        if ($this->container['agentId'] === null) {
            $invalid_properties[] = "'agentId' can't be null";
        }
        if ($this->container['pointsPerDay'] === null) {
            $invalid_properties[] = "'pointsPerDay' can't be null";
        }
        if ($this->container['remainderPoints'] === null) {
            $invalid_properties[] = "'remainderPoints' can't be null";
        }
        if ($this->container['skillTypeId'] === null) {
            $invalid_properties[] = "'skillTypeId' can't be null";
        }
        if ($this->container['startedAt'] === null) {
            $invalid_properties[] = "'startedAt' can't be null";
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
        if ($this->container['agentId'] === null) {
            return false;
        }
        if ($this->container['pointsPerDay'] === null) {
            return false;
        }
        if ($this->container['remainderPoints'] === null) {
            return false;
        }
        if ($this->container['skillTypeId'] === null) {
            return false;
        }
        if ($this->container['startedAt'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets agentId
     * @return int
     */
    public function getAgentId()
    {
        return $this->container['agentId'];
    }

    /**
     * Sets agentId
     * @param int $agentId agent_id integer
     * @return $this
     */
    public function setAgentId($agentId)
    {
        $this->container['agentId'] = $agentId;

        return $this;
    }

    /**
     * Gets pointsPerDay
     * @return float
     */
    public function getPointsPerDay()
    {
        return $this->container['pointsPerDay'];
    }

    /**
     * Sets pointsPerDay
     * @param float $pointsPerDay points_per_day number
     * @return $this
     */
    public function setPointsPerDay($pointsPerDay)
    {
        $this->container['pointsPerDay'] = $pointsPerDay;

        return $this;
    }

    /**
     * Gets remainderPoints
     * @return float
     */
    public function getRemainderPoints()
    {
        return $this->container['remainderPoints'];
    }

    /**
     * Sets remainderPoints
     * @param float $remainderPoints remainder_points number
     * @return $this
     */
    public function setRemainderPoints($remainderPoints)
    {
        $this->container['remainderPoints'] = $remainderPoints;

        return $this;
    }

    /**
     * Gets skillTypeId
     * @return int
     */
    public function getSkillTypeId()
    {
        return $this->container['skillTypeId'];
    }

    /**
     * Sets skillTypeId
     * @param int $skillTypeId skill_type_id integer
     * @return $this
     */
    public function setSkillTypeId($skillTypeId)
    {
        $this->container['skillTypeId'] = $skillTypeId;

        return $this;
    }

    /**
     * Gets startedAt
     * @return \DateTime
     */
    public function getStartedAt()
    {
        return $this->container['startedAt'];
    }

    /**
     * Sets startedAt
     * @param \DateTime $startedAt started_at string
     * @return $this
     */
    public function setStartedAt($startedAt)
    {
        $this->container['startedAt'] = $startedAt;

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


