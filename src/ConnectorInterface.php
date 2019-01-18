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

    public static function getReference(string $objectType, string $id, string $storeCode, string $referenceCode);
    public static function addReference(string $objectType, string $id, string $storeCode, string $referenceCode, $objects);
    public static function setReference(string $objectType, string $id, string $storeCode, string $referenceCode, $objects);
    public static function deleteReference(string $objectType, string $id, string $storeCode, string $referenceCode, $objects);

    public static function getGroupMembers(string $id, string $storeCode);
    public static function setGroupName(string $id, string $storeCode, $name);

    public static function setUsername(string $id, string $storeCode, string $username);
    public static function setUserFirstName(string $id, string $storeCode, string $firstName);
    public static function setUserLastName(string $id, string $storeCode, string $lastName);
    public static function getUserGroups(string $id, string $storeCode);
    public static function addUserToGroup(string $id, string $storeCode, string $groupid);
    public static function removeUserFromGroup(string $id, string $storeCode, string $groupid);

    public static function getPropertyValue(string $objectType, string $storeCode, string $id, string $propertyCode);
    public static function setPropertyValue(string $objectType, string $storeCode, string $id, string $propertyCode, $value);
    public static function deletePropertyValue(string $objectType, string $storeCode, string $id, string $propertyCode);

    // return the list of IDs of children/parents.
    public static function getChildren(string $objectType, string $storeCode, string $id, int $depth=null);
    public static function getParents(string $objectType, string $storeCode, string $id, int $depth=null);

    // return true/false
    public static function getDataStoreExists(string $name);
    public static function getUserStoreExists(string $name);

    // returns new data record ID
    public static function createDataRecord(string $storeCode, string $customType, string $parent=null);

    // returns null | ['id' => ID, 'typeClass' => TYPE_CLASSNAME]
    public static function getDataRecord(string $storeCode, string $id);

    // returns null | ['id' => ID, 'typeClass' => TYPE_CLASSNAME]
    public static function getDataRecordByValue(string $storeCode, string $propertyid, string $value);

    // return new user entityid
    public static function createUser(string $storeCode, string $username, string $firstName, string $lastName, string $type=null, array $groups=[]);

    // return new user group entityid
    public static function createGroup(string $storeCode, string $groupName, string $type, array $groups=[]);

    // returns null | ['id' => ID, 'groupName' => ...]
    public static function getGroup(string $storeCode, string $id);

    // returns null | ['id' => ID, 'username' => ...,  'firstName' => ..., 'lastName' => ...]
    public static function getUserByUsername(string $storeCode, string $username);
    public static function getUser(string $storeCode, string $id);

    // returns project instance ID
    public static function getProjectInstanceID();

    public static function login(string $id, string $storeCode);
    public static function logout();
    public static function getSecretKey();

    // returns the currently logged in user info like getUser() + 'storeCode' => STORE_CODE
    public static function getLoggedInUser();

    public static function sendEmail(string $to, string $from, string $subject, string $message);

    // returns the full namespaced class name.
    public static function getCustomTypeClassByName(string $objectType, string $type);

    public static function addQueueJob($queueNames, $data, callable $successCallback=null, callable $failedCallback=null);

    public static function getSessionValue(string $key);
    public static function setSessionValue(string $key, $value);

}//end interface
