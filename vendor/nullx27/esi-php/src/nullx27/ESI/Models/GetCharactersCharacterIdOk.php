<?php
/**
 * GetCharactersCharacterIdOk
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
 * GetCharactersCharacterIdOk Class Doc Comment
 *
 * @category Class
 * @description 200 ok object
 * @package  nullx27\ESI
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class GetCharactersCharacterIdOk implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'get_characters_character_id_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'name' => 'string',
        'description' => 'string',
        'corporationId' => 'int',
        'allianceId' => 'int',
        'birthday' => '\DateTime',
        'gender' => 'string',
        'raceId' => 'int',
        'bloodlineId' => 'int',
        'ancestryId' => 'int',
        'securityStatus' => 'float',
        'factionId' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'name' => null,
        'description' => null,
        'corporationId' => 'int32',
        'allianceId' => 'int32',
        'birthday' => 'date-time',
        'gender' => null,
        'raceId' => 'int32',
        'bloodlineId' => 'int32',
        'ancestryId' => 'int32',
        'securityStatus' => 'float',
        'factionId' => 'int32'
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
        'name' => 'name',
        'description' => 'description',
        'corporationId' => 'corporation_id',
        'allianceId' => 'alliance_id',
        'birthday' => 'birthday',
        'gender' => 'gender',
        'raceId' => 'race_id',
        'bloodlineId' => 'bloodline_id',
        'ancestryId' => 'ancestry_id',
        'securityStatus' => 'security_status',
        'factionId' => 'faction_id'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'description' => 'setDescription',
        'corporationId' => 'setCorporationId',
        'allianceId' => 'setAllianceId',
        'birthday' => 'setBirthday',
        'gender' => 'setGender',
        'raceId' => 'setRaceId',
        'bloodlineId' => 'setBloodlineId',
        'ancestryId' => 'setAncestryId',
        'securityStatus' => 'setSecurityStatus',
        'factionId' => 'setFactionId'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'description' => 'getDescription',
        'corporationId' => 'getCorporationId',
        'allianceId' => 'getAllianceId',
        'birthday' => 'getBirthday',
        'gender' => 'getGender',
        'raceId' => 'getRaceId',
        'bloodlineId' => 'getBloodlineId',
        'ancestryId' => 'getAncestryId',
        'securityStatus' => 'getSecurityStatus',
        'factionId' => 'getFactionId'
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

    const GENDER_FEMALE = 'female';
    const GENDER_MALE = 'male';
    

    
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getGenderAllowableValues()
    {
        return [
            self::GENDER_FEMALE,
            self::GENDER_MALE,
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
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['corporationId'] = isset($data['corporationId']) ? $data['corporationId'] : null;
        $this->container['allianceId'] = isset($data['allianceId']) ? $data['allianceId'] : null;
        $this->container['birthday'] = isset($data['birthday']) ? $data['birthday'] : null;
        $this->container['gender'] = isset($data['gender']) ? $data['gender'] : null;
        $this->container['raceId'] = isset($data['raceId']) ? $data['raceId'] : null;
        $this->container['bloodlineId'] = isset($data['bloodlineId']) ? $data['bloodlineId'] : null;
        $this->container['ancestryId'] = isset($data['ancestryId']) ? $data['ancestryId'] : null;
        $this->container['securityStatus'] = isset($data['securityStatus']) ? $data['securityStatus'] : null;
        $this->container['factionId'] = isset($data['factionId']) ? $data['factionId'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['corporationId'] === null) {
            $invalidProperties[] = "'corporationId' can't be null";
        }
        if ($this->container['birthday'] === null) {
            $invalidProperties[] = "'birthday' can't be null";
        }
        if ($this->container['gender'] === null) {
            $invalidProperties[] = "'gender' can't be null";
        }
        $allowedValues = $this->getGenderAllowableValues();
        if (!in_array($this->container['gender'], $allowedValues)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'gender', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['raceId'] === null) {
            $invalidProperties[] = "'raceId' can't be null";
        }
        if ($this->container['bloodlineId'] === null) {
            $invalidProperties[] = "'bloodlineId' can't be null";
        }
        if (!is_null($this->container['securityStatus']) && ($this->container['securityStatus'] > 10)) {
            $invalidProperties[] = "invalid value for 'securityStatus', must be smaller than or equal to 10.";
        }

        if (!is_null($this->container['securityStatus']) && ($this->container['securityStatus'] < -10)) {
            $invalidProperties[] = "invalid value for 'securityStatus', must be bigger than or equal to -10.";
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

        if ($this->container['name'] === null) {
            return false;
        }
        if ($this->container['corporationId'] === null) {
            return false;
        }
        if ($this->container['birthday'] === null) {
            return false;
        }
        if ($this->container['gender'] === null) {
            return false;
        }
        $allowedValues = $this->getGenderAllowableValues();
        if (!in_array($this->container['gender'], $allowedValues)) {
            return false;
        }
        if ($this->container['raceId'] === null) {
            return false;
        }
        if ($this->container['bloodlineId'] === null) {
            return false;
        }
        if ($this->container['securityStatus'] > 10) {
            return false;
        }
        if ($this->container['securityStatus'] < -10) {
            return false;
        }
        return true;
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
     * @param string $name name string
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description description string
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets corporationId
     *
     * @return int
     */
    public function getCorporationId()
    {
        return $this->container['corporationId'];
    }

    /**
     * Sets corporationId
     *
     * @param int $corporationId The character's corporation ID
     *
     * @return $this
     */
    public function setCorporationId($corporationId)
    {
        $this->container['corporationId'] = $corporationId;

        return $this;
    }

    /**
     * Gets allianceId
     *
     * @return int
     */
    public function getAllianceId()
    {
        return $this->container['allianceId'];
    }

    /**
     * Sets allianceId
     *
     * @param int $allianceId The character's alliance ID
     *
     * @return $this
     */
    public function setAllianceId($allianceId)
    {
        $this->container['allianceId'] = $allianceId;

        return $this;
    }

    /**
     * Gets birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->container['birthday'];
    }

    /**
     * Sets birthday
     *
     * @param \DateTime $birthday Creation date of the character
     *
     * @return $this
     */
    public function setBirthday($birthday)
    {
        $this->container['birthday'] = $birthday;

        return $this;
    }

    /**
     * Gets gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->container['gender'];
    }

    /**
     * Sets gender
     *
     * @param string $gender gender string
     *
     * @return $this
     */
    public function setGender($gender)
    {
        $allowedValues = $this->getGenderAllowableValues();
        if (!in_array($gender, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'gender', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['gender'] = $gender;

        return $this;
    }

    /**
     * Gets raceId
     *
     * @return int
     */
    public function getRaceId()
    {
        return $this->container['raceId'];
    }

    /**
     * Sets raceId
     *
     * @param int $raceId race_id integer
     *
     * @return $this
     */
    public function setRaceId($raceId)
    {
        $this->container['raceId'] = $raceId;

        return $this;
    }

    /**
     * Gets bloodlineId
     *
     * @return int
     */
    public function getBloodlineId()
    {
        return $this->container['bloodlineId'];
    }

    /**
     * Sets bloodlineId
     *
     * @param int $bloodlineId bloodline_id integer
     *
     * @return $this
     */
    public function setBloodlineId($bloodlineId)
    {
        $this->container['bloodlineId'] = $bloodlineId;

        return $this;
    }

    /**
     * Gets ancestryId
     *
     * @return int
     */
    public function getAncestryId()
    {
        return $this->container['ancestryId'];
    }

    /**
     * Sets ancestryId
     *
     * @param int $ancestryId ancestry_id integer
     *
     * @return $this
     */
    public function setAncestryId($ancestryId)
    {
        $this->container['ancestryId'] = $ancestryId;

        return $this;
    }

    /**
     * Gets securityStatus
     *
     * @return float
     */
    public function getSecurityStatus()
    {
        return $this->container['securityStatus'];
    }

    /**
     * Sets securityStatus
     *
     * @param float $securityStatus security_status number
     *
     * @return $this
     */
    public function setSecurityStatus($securityStatus)
    {

        if (!is_null($securityStatus) && ($securityStatus > 10)) {
            throw new \InvalidArgumentException('invalid value for $securityStatus when calling GetCharactersCharacterIdOk., must be smaller than or equal to 10.');
        }
        if (!is_null($securityStatus) && ($securityStatus < -10)) {
            throw new \InvalidArgumentException('invalid value for $securityStatus when calling GetCharactersCharacterIdOk., must be bigger than or equal to -10.');
        }

        $this->container['securityStatus'] = $securityStatus;

        return $this;
    }

    /**
     * Gets factionId
     *
     * @return int
     */
    public function getFactionId()
    {
        return $this->container['factionId'];
    }

    /**
     * Sets factionId
     *
     * @param int $factionId ID of the faction the character is fighting for, if the character is enlisted in Factional Warfare
     *
     * @return $this
     */
    public function setFactionId($factionId)
    {
        $this->container['factionId'] = $factionId;

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

