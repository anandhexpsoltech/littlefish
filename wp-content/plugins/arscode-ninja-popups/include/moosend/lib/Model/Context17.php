<?php
/**
 * Context17
 *
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swaagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Moosend API
 *
 * TODO: Add a description
 *
 * OpenAPI spec version: 1.0
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Swagger\Client\Model;

use \ArrayAccess;

/**
 * Context17 Class Doc Comment
 *
 * @category    Class
 * @package     Swagger\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class Context17 implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'Context17';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'active_member_count' => 'double',
        'bounced_member_count' => 'double',
        'created_by' => 'string',
        'created_on' => 'string',
        'custom_fields_definition' => '\Swagger\Client\Model\CustomFieldsDefinition[]',
        'id' => 'string',
        'import_operation' => '\Swagger\Client\Model\ImportOperation19',
        'name' => 'string',
        'removed_member_count' => 'double',
        'status' => 'double',
        'unsubscribed_member_count' => 'double',
        'updated_by' => 'string',
        'updated_on' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerFormats = [
        'active_member_count' => 'double',
        'bounced_member_count' => 'double',
        'created_by' => null,
        'created_on' => null,
        'custom_fields_definition' => null,
        'id' => null,
        'import_operation' => null,
        'name' => null,
        'removed_member_count' => 'double',
        'status' => 'double',
        'unsubscribed_member_count' => 'double',
        'updated_by' => null,
        'updated_on' => null
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'active_member_count' => 'ActiveMemberCount',
        'bounced_member_count' => 'BouncedMemberCount',
        'created_by' => 'CreatedBy',
        'created_on' => 'CreatedOn',
        'custom_fields_definition' => 'CustomFieldsDefinition',
        'id' => 'ID',
        'import_operation' => 'ImportOperation',
        'name' => 'Name',
        'removed_member_count' => 'RemovedMemberCount',
        'status' => 'Status',
        'unsubscribed_member_count' => 'UnsubscribedMemberCount',
        'updated_by' => 'UpdatedBy',
        'updated_on' => 'UpdatedOn'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'active_member_count' => 'setActiveMemberCount',
        'bounced_member_count' => 'setBouncedMemberCount',
        'created_by' => 'setCreatedBy',
        'created_on' => 'setCreatedOn',
        'custom_fields_definition' => 'setCustomFieldsDefinition',
        'id' => 'setId',
        'import_operation' => 'setImportOperation',
        'name' => 'setName',
        'removed_member_count' => 'setRemovedMemberCount',
        'status' => 'setStatus',
        'unsubscribed_member_count' => 'setUnsubscribedMemberCount',
        'updated_by' => 'setUpdatedBy',
        'updated_on' => 'setUpdatedOn'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'active_member_count' => 'getActiveMemberCount',
        'bounced_member_count' => 'getBouncedMemberCount',
        'created_by' => 'getCreatedBy',
        'created_on' => 'getCreatedOn',
        'custom_fields_definition' => 'getCustomFieldsDefinition',
        'id' => 'getId',
        'import_operation' => 'getImportOperation',
        'name' => 'getName',
        'removed_member_count' => 'getRemovedMemberCount',
        'status' => 'getStatus',
        'unsubscribed_member_count' => 'getUnsubscribedMemberCount',
        'updated_by' => 'getUpdatedBy',
        'updated_on' => 'getUpdatedOn'
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
        $this->container['active_member_count'] = isset($data['active_member_count']) ? $data['active_member_count'] : null;
        $this->container['bounced_member_count'] = isset($data['bounced_member_count']) ? $data['bounced_member_count'] : null;
        $this->container['created_by'] = isset($data['created_by']) ? $data['created_by'] : null;
        $this->container['created_on'] = isset($data['created_on']) ? $data['created_on'] : null;
        $this->container['custom_fields_definition'] = isset($data['custom_fields_definition']) ? $data['custom_fields_definition'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['import_operation'] = isset($data['import_operation']) ? $data['import_operation'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['removed_member_count'] = isset($data['removed_member_count']) ? $data['removed_member_count'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['unsubscribed_member_count'] = isset($data['unsubscribed_member_count']) ? $data['unsubscribed_member_count'] : null;
        $this->container['updated_by'] = isset($data['updated_by']) ? $data['updated_by'] : null;
        $this->container['updated_on'] = isset($data['updated_on']) ? $data['updated_on'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        return true;
    }


    /**
     * Gets active_member_count
     * @return double
     */
    public function getActiveMemberCount()
    {
        return $this->container['active_member_count'];
    }

    /**
     * Sets active_member_count
     * @param double $active_member_count 
     * @return $this
     */
    public function setActiveMemberCount($active_member_count)
    {
        $this->container['active_member_count'] = $active_member_count;

        return $this;
    }

    /**
     * Gets bounced_member_count
     * @return double
     */
    public function getBouncedMemberCount()
    {
        return $this->container['bounced_member_count'];
    }

    /**
     * Sets bounced_member_count
     * @param double $bounced_member_count 
     * @return $this
     */
    public function setBouncedMemberCount($bounced_member_count)
    {
        $this->container['bounced_member_count'] = $bounced_member_count;

        return $this;
    }

    /**
     * Gets created_by
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->container['created_by'];
    }

    /**
     * Sets created_by
     * @param string $created_by 
     * @return $this
     */
    public function setCreatedBy($created_by)
    {
        $this->container['created_by'] = $created_by;

        return $this;
    }

    /**
     * Gets created_on
     * @return string
     */
    public function getCreatedOn()
    {
        return $this->container['created_on'];
    }

    /**
     * Sets created_on
     * @param string $created_on 
     * @return $this
     */
    public function setCreatedOn($created_on)
    {
        $this->container['created_on'] = $created_on;

        return $this;
    }

    /**
     * Gets custom_fields_definition
     * @return \Swagger\Client\Model\CustomFieldsDefinition[]
     */
    public function getCustomFieldsDefinition()
    {
        return $this->container['custom_fields_definition'];
    }

    /**
     * Sets custom_fields_definition
     * @param \Swagger\Client\Model\CustomFieldsDefinition[] $custom_fields_definition 
     * @return $this
     */
    public function setCustomFieldsDefinition($custom_fields_definition)
    {
        $this->container['custom_fields_definition'] = $custom_fields_definition;

        return $this;
    }

    /**
     * Gets id
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     * @param string $id 
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets import_operation
     * @return \Swagger\Client\Model\ImportOperation19
     */
    public function getImportOperation()
    {
        return $this->container['import_operation'];
    }

    /**
     * Sets import_operation
     * @param \Swagger\Client\Model\ImportOperation19 $import_operation
     * @return $this
     */
    public function setImportOperation($import_operation)
    {
        $this->container['import_operation'] = $import_operation;

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
     * @param string $name 
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets removed_member_count
     * @return double
     */
    public function getRemovedMemberCount()
    {
        return $this->container['removed_member_count'];
    }

    /**
     * Sets removed_member_count
     * @param double $removed_member_count 
     * @return $this
     */
    public function setRemovedMemberCount($removed_member_count)
    {
        $this->container['removed_member_count'] = $removed_member_count;

        return $this;
    }

    /**
     * Gets status
     * @return double
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     * @param double $status 
     * @return $this
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets unsubscribed_member_count
     * @return double
     */
    public function getUnsubscribedMemberCount()
    {
        return $this->container['unsubscribed_member_count'];
    }

    /**
     * Sets unsubscribed_member_count
     * @param double $unsubscribed_member_count 
     * @return $this
     */
    public function setUnsubscribedMemberCount($unsubscribed_member_count)
    {
        $this->container['unsubscribed_member_count'] = $unsubscribed_member_count;

        return $this;
    }

    /**
     * Gets updated_by
     * @return string
     */
    public function getUpdatedBy()
    {
        return $this->container['updated_by'];
    }

    /**
     * Sets updated_by
     * @param string $updated_by 
     * @return $this
     */
    public function setUpdatedBy($updated_by)
    {
        $this->container['updated_by'] = $updated_by;

        return $this;
    }

    /**
     * Gets updated_on
     * @return string
     */
    public function getUpdatedOn()
    {
        return $this->container['updated_on'];
    }

    /**
     * Sets updated_on
     * @param string $updated_on 
     * @return $this
     */
    public function setUpdatedOn($updated_on)
    {
        $this->container['updated_on'] = $updated_on;

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
            return json_encode(\Swagger\Client\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\Swagger\Client\ObjectSerializer::sanitizeForSerialization($this));
    }
}


