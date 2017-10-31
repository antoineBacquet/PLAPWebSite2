<?php
/**
 * GetCharactersCharacterIdCalendarEventIdOk
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
 * GetCharactersCharacterIdCalendarEventIdOk Class Doc Comment
 *
 * @category    Class */
 // @description Full details of a specific event
/**
 * @package     nullx27\ESI
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class GetCharactersCharacterIdCalendarEventIdOk implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'get_characters_character_id_calendar_event_id_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'date' => '\DateTime',
        'duration' => 'int',
        'eventId' => 'int',
        'importance' => 'int',
        'ownerId' => 'int',
        'ownerName' => 'string',
        'ownerType' => 'string',
        'response' => 'string',
        'text' => 'string',
        'title' => 'string'
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
        'date' => 'date',
        'duration' => 'duration',
        'eventId' => 'event_id',
        'importance' => 'importance',
        'ownerId' => 'owner_id',
        'ownerName' => 'owner_name',
        'ownerType' => 'owner_type',
        'response' => 'response',
        'text' => 'text',
        'title' => 'title'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'date' => 'setDate',
        'duration' => 'setDuration',
        'eventId' => 'setEventId',
        'importance' => 'setImportance',
        'ownerId' => 'setOwnerId',
        'ownerName' => 'setOwnerName',
        'ownerType' => 'setOwnerType',
        'response' => 'setResponse',
        'text' => 'setText',
        'title' => 'setTitle'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'date' => 'getDate',
        'duration' => 'getDuration',
        'eventId' => 'getEventId',
        'importance' => 'getImportance',
        'ownerId' => 'getOwnerId',
        'ownerName' => 'getOwnerName',
        'ownerType' => 'getOwnerType',
        'response' => 'getResponse',
        'text' => 'getText',
        'title' => 'getTitle'
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

    const OWNER_TYPE_EVE_SERVER = 'eve_server';
    const OWNER_TYPE_CORPORATION = 'corporation';
    const OWNER_TYPE_FACTION = 'faction';
    const OWNER_TYPE_CHARACTER = 'character';
    const OWNER_TYPE_ALLIANCE = 'alliance';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getOwnerTypeAllowableValues()
    {
        return [
            self::OWNER_TYPE_EVE_SERVER,
            self::OWNER_TYPE_CORPORATION,
            self::OWNER_TYPE_FACTION,
            self::OWNER_TYPE_CHARACTER,
            self::OWNER_TYPE_ALLIANCE,
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
        $this->container['date'] = isset($data['date']) ? $data['date'] : null;
        $this->container['duration'] = isset($data['duration']) ? $data['duration'] : null;
        $this->container['eventId'] = isset($data['eventId']) ? $data['eventId'] : null;
        $this->container['importance'] = isset($data['importance']) ? $data['importance'] : null;
        $this->container['ownerId'] = isset($data['ownerId']) ? $data['ownerId'] : null;
        $this->container['ownerName'] = isset($data['ownerName']) ? $data['ownerName'] : null;
        $this->container['ownerType'] = isset($data['ownerType']) ? $data['ownerType'] : null;
        $this->container['response'] = isset($data['response']) ? $data['response'] : null;
        $this->container['text'] = isset($data['text']) ? $data['text'] : null;
        $this->container['title'] = isset($data['title']) ? $data['title'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        if ($this->container['date'] === null) {
            $invalid_properties[] = "'date' can't be null";
        }
        if ($this->container['duration'] === null) {
            $invalid_properties[] = "'duration' can't be null";
        }
        if ($this->container['eventId'] === null) {
            $invalid_properties[] = "'eventId' can't be null";
        }
        if ($this->container['importance'] === null) {
            $invalid_properties[] = "'importance' can't be null";
        }
        if ($this->container['ownerId'] === null) {
            $invalid_properties[] = "'ownerId' can't be null";
        }
        if ($this->container['ownerName'] === null) {
            $invalid_properties[] = "'ownerName' can't be null";
        }
        if ($this->container['ownerType'] === null) {
            $invalid_properties[] = "'ownerType' can't be null";
        }
        $allowed_values = ["eve_server", "corporation", "faction", "character", "alliance"];
        if (!in_array($this->container['ownerType'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'ownerType', must be one of #{allowed_values}.";
        }

        if ($this->container['response'] === null) {
            $invalid_properties[] = "'response' can't be null";
        }
        if ($this->container['text'] === null) {
            $invalid_properties[] = "'text' can't be null";
        }
        if ($this->container['title'] === null) {
            $invalid_properties[] = "'title' can't be null";
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
        if ($this->container['date'] === null) {
            return false;
        }
        if ($this->container['duration'] === null) {
            return false;
        }
        if ($this->container['eventId'] === null) {
            return false;
        }
        if ($this->container['importance'] === null) {
            return false;
        }
        if ($this->container['ownerId'] === null) {
            return false;
        }
        if ($this->container['ownerName'] === null) {
            return false;
        }
        if ($this->container['ownerType'] === null) {
            return false;
        }
        $allowed_values = ["eve_server", "corporation", "faction", "character", "alliance"];
        if (!in_array($this->container['ownerType'], $allowed_values)) {
            return false;
        }
        if ($this->container['response'] === null) {
            return false;
        }
        if ($this->container['text'] === null) {
            return false;
        }
        if ($this->container['title'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets date
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     * @param \DateTime $date date string
     * @return $this
     */
    public function setDate($date)
    {
        $this->container['date'] = $date;

        return $this;
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
     * @param int $duration Length in minutes
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->container['duration'] = $duration;

        return $this;
    }

    /**
     * Gets eventId
     * @return int
     */
    public function getEventId()
    {
        return $this->container['eventId'];
    }

    /**
     * Sets eventId
     * @param int $eventId event_id integer
     * @return $this
     */
    public function setEventId($eventId)
    {
        $this->container['eventId'] = $eventId;

        return $this;
    }

    /**
     * Gets importance
     * @return int
     */
    public function getImportance()
    {
        return $this->container['importance'];
    }

    /**
     * Sets importance
     * @param int $importance importance integer
     * @return $this
     */
    public function setImportance($importance)
    {
        $this->container['importance'] = $importance;

        return $this;
    }

    /**
     * Gets ownerId
     * @return int
     */
    public function getOwnerId()
    {
        return $this->container['ownerId'];
    }

    /**
     * Sets ownerId
     * @param int $ownerId owner_id integer
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->container['ownerId'] = $ownerId;

        return $this;
    }

    /**
     * Gets ownerName
     * @return string
     */
    public function getOwnerName()
    {
        return $this->container['ownerName'];
    }

    /**
     * Sets ownerName
     * @param string $ownerName owner_name string
     * @return $this
     */
    public function setOwnerName($ownerName)
    {
        $this->container['ownerName'] = $ownerName;

        return $this;
    }

    /**
     * Gets ownerType
     * @return string
     */
    public function getOwnerType()
    {
        return $this->container['ownerType'];
    }

    /**
     * Sets ownerType
     * @param string $ownerType owner_type string
     * @return $this
     */
    public function setOwnerType($ownerType)
    {
        $allowed_values = array('eve_server', 'corporation', 'faction', 'character', 'alliance');
        if ((!in_array($ownerType, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'ownerType', must be one of 'eve_server', 'corporation', 'faction', 'character', 'alliance'");
        }
        $this->container['ownerType'] = $ownerType;

        return $this;
    }

    /**
     * Gets response
     * @return string
     */
    public function getResponse()
    {
        return $this->container['response'];
    }

    /**
     * Sets response
     * @param string $response response string
     * @return $this
     */
    public function setResponse($response)
    {
        $this->container['response'] = $response;

        return $this;
    }

    /**
     * Gets text
     * @return string
     */
    public function getText()
    {
        return $this->container['text'];
    }

    /**
     * Sets text
     * @param string $text text string
     * @return $this
     */
    public function setText($text)
    {
        $this->container['text'] = $text;

        return $this;
    }

    /**
     * Gets title
     * @return string
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     * @param string $title title string
     * @return $this
     */
    public function setTitle($title)
    {
        $this->container['title'] = $title;

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

