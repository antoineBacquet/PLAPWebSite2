<?php
/**
 * GetSovereigntyCampaigns200Ok
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
 * GetSovereigntyCampaigns200Ok Class Doc Comment
 *
 * @category Class
 * @description 200 ok object
 * @package  nullx27\ESI
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class GetSovereigntyCampaigns200Ok implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'get_sovereignty_campaigns_200_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'campaignId' => 'int',
        'structureId' => 'int',
        'solarSystemId' => 'int',
        'constellationId' => 'int',
        'eventType' => 'string',
        'startTime' => '\DateTime',
        'defenderId' => 'int',
        'defenderScore' => 'float',
        'attackersScore' => 'float',
        'participants' => '\nullx27\ESI\nullx27\ESI\Models\GetSovereigntyCampaignsParticipant[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'campaignId' => 'int32',
        'structureId' => 'int64',
        'solarSystemId' => 'int32',
        'constellationId' => 'int32',
        'eventType' => null,
        'startTime' => 'date-time',
        'defenderId' => 'int32',
        'defenderScore' => 'float',
        'attackersScore' => 'float',
        'participants' => null
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
        'campaignId' => 'campaign_id',
        'structureId' => 'structure_id',
        'solarSystemId' => 'solar_system_id',
        'constellationId' => 'constellation_id',
        'eventType' => 'event_type',
        'startTime' => 'start_time',
        'defenderId' => 'defender_id',
        'defenderScore' => 'defender_score',
        'attackersScore' => 'attackers_score',
        'participants' => 'participants'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'campaignId' => 'setCampaignId',
        'structureId' => 'setStructureId',
        'solarSystemId' => 'setSolarSystemId',
        'constellationId' => 'setConstellationId',
        'eventType' => 'setEventType',
        'startTime' => 'setStartTime',
        'defenderId' => 'setDefenderId',
        'defenderScore' => 'setDefenderScore',
        'attackersScore' => 'setAttackersScore',
        'participants' => 'setParticipants'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'campaignId' => 'getCampaignId',
        'structureId' => 'getStructureId',
        'solarSystemId' => 'getSolarSystemId',
        'constellationId' => 'getConstellationId',
        'eventType' => 'getEventType',
        'startTime' => 'getStartTime',
        'defenderId' => 'getDefenderId',
        'defenderScore' => 'getDefenderScore',
        'attackersScore' => 'getAttackersScore',
        'participants' => 'getParticipants'
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

    const EVENT_TYPE_TCU_DEFENSE = 'tcu_defense';
    const EVENT_TYPE_IHUB_DEFENSE = 'ihub_defense';
    const EVENT_TYPE_STATION_DEFENSE = 'station_defense';
    const EVENT_TYPE_STATION_FREEPORT = 'station_freeport';
    

    
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEventTypeAllowableValues()
    {
        return [
            self::EVENT_TYPE_TCU_DEFENSE,
            self::EVENT_TYPE_IHUB_DEFENSE,
            self::EVENT_TYPE_STATION_DEFENSE,
            self::EVENT_TYPE_STATION_FREEPORT,
        ];
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
        $this->container['campaignId'] = isset($data['campaignId']) ? $data['campaignId'] : null;
        $this->container['structureId'] = isset($data['structureId']) ? $data['structureId'] : null;
        $this->container['solarSystemId'] = isset($data['solarSystemId']) ? $data['solarSystemId'] : null;
        $this->container['constellationId'] = isset($data['constellationId']) ? $data['constellationId'] : null;
        $this->container['eventType'] = isset($data['eventType']) ? $data['eventType'] : null;
        $this->container['startTime'] = isset($data['startTime']) ? $data['startTime'] : null;
        $this->container['defenderId'] = isset($data['defenderId']) ? $data['defenderId'] : null;
        $this->container['defenderScore'] = isset($data['defenderScore']) ? $data['defenderScore'] : null;
        $this->container['attackersScore'] = isset($data['attackersScore']) ? $data['attackersScore'] : null;
        $this->container['participants'] = isset($data['participants']) ? $data['participants'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['campaignId'] === null) {
            $invalidProperties[] = "'campaignId' can't be null";
        }
        if ($this->container['structureId'] === null) {
            $invalidProperties[] = "'structureId' can't be null";
        }
        if ($this->container['solarSystemId'] === null) {
            $invalidProperties[] = "'solarSystemId' can't be null";
        }
        if ($this->container['constellationId'] === null) {
            $invalidProperties[] = "'constellationId' can't be null";
        }
        if ($this->container['eventType'] === null) {
            $invalidProperties[] = "'eventType' can't be null";
        }
        $allowedValues = $this->getEventTypeAllowableValues();
        if (!in_array($this->container['eventType'], $allowedValues)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'eventType', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['startTime'] === null) {
            $invalidProperties[] = "'startTime' can't be null";
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

        if ($this->container['campaignId'] === null) {
            return false;
        }
        if ($this->container['structureId'] === null) {
            return false;
        }
        if ($this->container['solarSystemId'] === null) {
            return false;
        }
        if ($this->container['constellationId'] === null) {
            return false;
        }
        if ($this->container['eventType'] === null) {
            return false;
        }
        $allowedValues = $this->getEventTypeAllowableValues();
        if (!in_array($this->container['eventType'], $allowedValues)) {
            return false;
        }
        if ($this->container['startTime'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets campaignId
     *
     * @return int
     */
    public function getCampaignId()
    {
        return $this->container['campaignId'];
    }

    /**
     * Sets campaignId
     *
     * @param int $campaignId Unique ID for this campaign.
     *
     * @return $this
     */
    public function setCampaignId($campaignId)
    {
        $this->container['campaignId'] = $campaignId;

        return $this;
    }

    /**
     * Gets structureId
     *
     * @return int
     */
    public function getStructureId()
    {
        return $this->container['structureId'];
    }

    /**
     * Sets structureId
     *
     * @param int $structureId The structure item ID that is related to this campaign.
     *
     * @return $this
     */
    public function setStructureId($structureId)
    {
        $this->container['structureId'] = $structureId;

        return $this;
    }

    /**
     * Gets solarSystemId
     *
     * @return int
     */
    public function getSolarSystemId()
    {
        return $this->container['solarSystemId'];
    }

    /**
     * Sets solarSystemId
     *
     * @param int $solarSystemId The solar system the structure is located in.
     *
     * @return $this
     */
    public function setSolarSystemId($solarSystemId)
    {
        $this->container['solarSystemId'] = $solarSystemId;

        return $this;
    }

    /**
     * Gets constellationId
     *
     * @return int
     */
    public function getConstellationId()
    {
        return $this->container['constellationId'];
    }

    /**
     * Sets constellationId
     *
     * @param int $constellationId The constellation in which the campaign will take place.
     *
     * @return $this
     */
    public function setConstellationId($constellationId)
    {
        $this->container['constellationId'] = $constellationId;

        return $this;
    }

    /**
     * Gets eventType
     *
     * @return string
     */
    public function getEventType()
    {
        return $this->container['eventType'];
    }

    /**
     * Sets eventType
     *
     * @param string $eventType Type of event this campaign is for. tcu_defense, ihub_defense and station_defense are referred to as \"Defense Events\", station_freeport as \"Freeport Events\".
     *
     * @return $this
     */
    public function setEventType($eventType)
    {
        $allowedValues = $this->getEventTypeAllowableValues();
        if (!in_array($eventType, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'eventType', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['eventType'] = $eventType;

        return $this;
    }

    /**
     * Gets startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->container['startTime'];
    }

    /**
     * Sets startTime
     *
     * @param \DateTime $startTime Time the event is scheduled to start.
     *
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->container['startTime'] = $startTime;

        return $this;
    }

    /**
     * Gets defenderId
     *
     * @return int
     */
    public function getDefenderId()
    {
        return $this->container['defenderId'];
    }

    /**
     * Sets defenderId
     *
     * @param int $defenderId Defending alliance, only present in Defense Events
     *
     * @return $this
     */
    public function setDefenderId($defenderId)
    {
        $this->container['defenderId'] = $defenderId;

        return $this;
    }

    /**
     * Gets defenderScore
     *
     * @return float
     */
    public function getDefenderScore()
    {
        return $this->container['defenderScore'];
    }

    /**
     * Sets defenderScore
     *
     * @param float $defenderScore Score for the defending alliance, only present in Defense Events.
     *
     * @return $this
     */
    public function setDefenderScore($defenderScore)
    {
        $this->container['defenderScore'] = $defenderScore;

        return $this;
    }

    /**
     * Gets attackersScore
     *
     * @return float
     */
    public function getAttackersScore()
    {
        return $this->container['attackersScore'];
    }

    /**
     * Sets attackersScore
     *
     * @param float $attackersScore Score for all attacking parties, only present in Defense Events.
     *
     * @return $this
     */
    public function setAttackersScore($attackersScore)
    {
        $this->container['attackersScore'] = $attackersScore;

        return $this;
    }

    /**
     * Gets participants
     *
     * @return \nullx27\ESI\nullx27\ESI\Models\GetSovereigntyCampaignsParticipant[]
     */
    public function getParticipants()
    {
        return $this->container['participants'];
    }

    /**
     * Sets participants
     *
     * @param \nullx27\ESI\nullx27\ESI\Models\GetSovereigntyCampaignsParticipant[] $participants Alliance participating and their respective scores, only present in Freeport Events.
     *
     * @return $this
     */
    public function setParticipants($participants)
    {
        $this->container['participants'] = $participants;

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


