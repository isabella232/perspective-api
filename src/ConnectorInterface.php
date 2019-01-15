<?php
/**
 * Connector interface.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI;

/**
 * Connector Interface.
 */
interface ConnectorInterface
{

    public static function getPropertyTypeClass(string $objectType, string $propertyCode);

    public static function addReference(string $objectType, string $id, string $referenceCode, $objects);
    public static function setReference(string $objectType, string $id, string $referenceCode, $objects);
    public static function deleteReference(string $objectType, string $id, string $referenceCode, $objects);

    public static function getGroupMembers(string $id);
    public static function setGroupName(string $id, $name);

    public static function setUsername(string $id, string $username);
    public static function setUserFirstName(string $id, string $firstName);
    public static function setUserLastName(string $id, string $lastName);
    public static function getUserGroups(string $id);
    public static function addUserToGroup(string $id, string $groupid);
    public static function removeUserFromGroup(string $id, string $groupid);

    public static function getPropertyValue(string $objectType, string $id, string $propertyCode);
    public static function setPropertyValue(string $objectType, string $id, string $propertyCode, $value);
    public static function deletePropertyValue(string $objectType, string $id, string $propertyCode);

    public static function getDataStore(string $name);
    public static function getUserStore(string $name);

    public static function createDataRecord(string $storeCode, string $customType, string $parent=null);
    public static function getDataRecord(string $storeCode, string $id);
    public static function getDataRecordByValue(string $storeCode, string $propertyid, string $value);

    public static function createUser(string $storeCode, string $username, string $firstName, string $lastName, string $type=null, array $groups=[]);
    public static function createGroup(string $storeCode, string $groupName, array $groups=[]);
    public static function getGroup(string $storeCode, string $id);
    public static function getUserByUsername(string $storeCode, string $username);

    public static function getProject();

    public static function login(string $id);
    public static function logout();

    public static function sendEmail(string $to, string $from, string $subject, string $message);

}//end interface
