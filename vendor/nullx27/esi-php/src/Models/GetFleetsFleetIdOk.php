<?php
/**
 * GetFleetsFleetIdOk
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
 * GetFleetsFleetIdOk Class Doc Comment
 *
 * @category    Class */
 // @description 200 ok object
/**
 * @package     nullx27\ESI
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class GetFleetsFleetIdOk implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'get_fleets_fleet_id_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'isFreeMove' => 'bool',
        'isRegistered' => 'bool',
        'isVoiceEnabled' => 'bool',
        'motd' => 'string'
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
        'isFreeMove' => 'is_free_move',
        'isRegistered' => 'is_registered',
        'isVoiceEnabled' => 'is_voice_enabled',
        'motd' => 'motd'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'isFreeMove' => 'setIsFreeMove',
        'isRegistered' => 'setIsRegistered',
        'isVoiceEnabled' => 'setIsVoiceEnabled',
        'motd' => 'setMotd'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'isFreeMove' => 'getIsFreeMove',
        'isRegistered' => 'getIsRegistered',
        'isVoiceEnabled' => 'getIsVoiceEnabled',
        'motd' => 'getMotd'
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
        $this->container['isFreeMove'] = isset($data['isFreeMove']) ? $data['isFreeMove'] : null;
        $this->container['isRegistered'] = isset($data['isRegistered']) ? $data['isRegistered'] : null;
        $this->container['isVoiceEnabled'] = isset($data['isVoiceEnabled']) ? $data['isVoiceEnabled'] : null;
        $this->container['motd'] = isset($data['motd']) ? $data['motd'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        if ($this->container['isFreeMove'] === null) {
            $invalid_properties[] = "'isFreeMove' can't be null";
        }
        if ($this->container['isRegistered'] === null) {
            $invalid_properties[] = "'isRegistered' can't be null";
        }
        if ($this->container['isVoiceEnabled'] === null) {
            $invalid_properties[] = "'isVoiceEnabled' can't be null";
        }
        if ($this->container['motd'] === null) {
            $invalid_properties[] = "'motd' can't be null";
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
        if ($this->container['isFreeMove'] === null) {
            return false;
        }
        if ($this->container['isRegistered'] === null) {
            return false;
        }
        if ($this->container['isVoiceEnabled'] === null) {
            return false;
        }
        if ($this->container['motd'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets isFreeMove
     * @return bool
     */
    public function getIsFreeMove()
    {
        return $this->container['isFreeMove'];
    }

    /**
     * Sets isFreeMove
     * @param bool $isFreeMove Is free-move enabled
     * @return $this
     */
    public function setIsFreeMove($isFreeMove)
    {
        $this->container['isFreeMove'] = $isFreeMove;

        return $this;
    }

    /**
     * Gets isRegistered
     * @return bool
     */
    public function getIsRegistered()
    {
        return $this->container['isRegistered'];
    }

    /**
     * Sets isRegistered
     * @param bool $isRegistered Does the fleet have an active fleet advertisement
     * @return $this
     */
    public function setIsRegistered($isRegistered)
    {
        $this->container['isRegistered'] = $isRegistered;

        return $this;
    }

    /**
     * Gets isVoiceEnabled
     * @return bool
     */
    public function getIsVoiceEnabled()
    {
        return $this->container['isVoiceEnabled'];
    }

    /**
     * Sets isVoiceEnabled
     * @param bool $isVoiceEnabled Is EVE Voice enabled
     * @return $this
     */
    public function setIsVoiceEnabled($isVoiceEnabled)
    {
        $this->container['isVoiceEnabled'] = $isVoiceEnabled;

        return $this;
    }

    /**
     * Gets motd
     * @return string
     */
    public function getMotd()
    {
        return $this->container['motd'];
    }

    /**
     * Sets motd
     * @param string $motd Fleet MOTD in CCP flavoured HTML
     * @return $this
     */
    public function setMotd($motd)
    {
        $this->container['motd'] = $motd;

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


