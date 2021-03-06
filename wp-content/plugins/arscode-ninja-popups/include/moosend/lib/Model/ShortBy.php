<?php
/**
 * ShortBy
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

/**
 * ShortBy Class Doc Comment
 *
 * @category    Class
 * @package     Swagger\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class ShortBy
{
    /**
     * Possible values of this enum
     */
    const NAME = 'Name';
    const SUBJECT = 'Subject';
    const STATUS = 'Status';
    const DELIVERED_ON = 'DeliveredOn';
    const CREATED_ON = 'CreatedOn';
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::NAME,
            self::SUBJECT,
            self::STATUS,
            self::DELIVERED_ON,
            self::CREATED_ON,
        ];
    }
}


