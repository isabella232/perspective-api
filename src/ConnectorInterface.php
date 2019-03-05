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

    /**
     * Get reference.
     *
     * @param string $objectType    The object type.
     * @param string $id            The object ID.
     * @param string $storeCode     The store code.
     * @param string $referenceCode The reference code.
     *
     * @return mixed
     * @throws InvalidDataException Thrown when store code is not found.
     * @throws InvalidDataException Thrown when reference code is not found.
     */
    public static function getReference(string $objectType, string $id, string $storeCode, string $referenceCode);


    /**
     * Add reference.
     *
     * @param string $objectType    The object type.
     * @param string $id            The object ID.
     * @param string $storeCode     The store code.
     * @param string $referenceCode The reference code.
     * @param mixed  $objects       One or more objects to add to the reference, retrieved from the store that the
     *                              reference points to.
     *
     * @return mixed
     * @throws InvalidDataException Thrown when store code is not found.
     * @throws InvalidDataException Thrown when reference code is not found.
     */
    public static function addReference(string $objectType, string $id, string $storeCode, string $referenceCode, $objects);


    /**
     * Set reference.
     *
     * @param string $objectType    The object type.
     * @param string $id            The object ID.
     * @param string $storeCode     The store code.
     * @param string $referenceCode The reference code.
     * @param mixed  $objects       One or more objects to add to the reference, retrieved from the store that the
     *                              reference points to.
     *
     * @return mixed
     * @throws InvalidDataException Thrown when store code is not found.
     * @throws InvalidDataException Thrown when reference code is not found.
     */
    public static function setReference(string $objectType, string $id, string $storeCode, string $referenceCode, $objects);


    /**
     * Delete reference.
     *
     * @param string $objectType    The object type.
     * @param string $id            The object ID.
     * @param string $storeCode     The store code.
     * @param string $referenceCode The reference code.
     * @param mixed  $objects       One or more objects to add to the reference, retrieved from the store that the
     *                              reference points to.
     *
     * @return mixed
     * @throws InvalidDataException Thrown when store code is not found.
     * @throws InvalidDataException Thrown when reference code is not found.
     */
    public static function deleteReference(string $objectType, string $id, string $storeCode, string $referenceCode, $objects);


    /**
     * Returns all user entityids in a specified group.
     *
     * @param string $id        The group ID.
     * @param string $storeCode The store code.
     *
     * @return array
     * @throws InvalidDataException Thrown when store code is not found.
     * @throws InvalidDataException Thrown group id is not found.
     */
    public static function getGroupMembers(string $id, string $storeCode);


    /**
     * Sets the name of the user group.
     *
     * @param string $id        The group ID.
     * @param string $storeCode The store code.
     * @param string $name      The name of the group to set.
     *
     * @return void
     * @throws InvalidDataException Thrown when store code is not found.
     * @throws InvalidDataException Thrown group id is not found.
     */
    public static function setGroupName(string $id, string $storeCode, $name);


    /**
     * Set username.
     *
     * @param string $id        The user ID.
     * @param string $storeCode The store code.
     * @param string $username  The username to set.
     *
     * @return void
     * @throws InvalidDataException Thrown when store code is not found.
     * @throws InvalidDataException Thrown user id is not found.
     */
    public static function setUsername(string $id, string $storeCode, string $username);


    /**
     * Set first name.
     *
     * @param string $id        The user ID.
     * @param string $storeCode The store code.
     * @param string $firstName The first name of the user.
     *
     * @return void
     * @throws InvalidDataException Thrown when store code is not found.
     * @throws InvalidDataException Thrown user id is not found.
     */
    public static function setUserFirstName(string $id, string $storeCode, string $firstName);


    /**
     * Set last name.
     *
     * @param string $id        The user ID.
     * @param string $storeCode The store code.
     * @param string $lastName  The last name of the user.
     *
     * @return void
     * @throws InvalidDataException Thrown when store code is not found.
     * @throws InvalidDataException Thrown user id is not found.
     */
    public static function setUserLastName(string $id, string $storeCode, string $lastName);


    /**
     * Returns all parent group entityids for a specified user.
     *
     * @param string $id        The user ID.
     * @param string $storeCode The store code.
     *
     * @return array
     * @throws InvalidDataException Thrown when store code is not found.
     * @throws InvalidDataException Thrown group id is not found.
     */
    public static function getUserGroups(string $id, string $storeCode);


    /**
     * Assign an user to parent groups.
     *
     * @param string $id        The user ID.
     * @param string $storeCode The store code.
     * @param mixed  $groupid   Parent user groups to assign the user to.
     *
     * @return void
     * @throws InvalidDataException Thrown when store code is not found.
     * @throws InvalidDataException Thrown user id is not found.
     * @throws InvalidDataException Thrown group id is not found.
     */
    public static function addUserToGroup(string $id, string $storeCode, string $groupid);


    /**
     * Remove an user from specified parent groups.
     *
     * @param string $id        The user ID.
     * @param string $storeCode The store code.
     * @param mixed  $groupid   Parent user groups to remove the user from.
     *
     * @return void
     * @throws InvalidDataException Thrown when store code is not found.
     * @throws InvalidDataException Thrown user id is not found.
     * @throws InvalidDataException Thrown group id is not found.
     */
    public static function removeUserFromGroup(string $id, string $storeCode, string $groupid);


    /**
     * Gets the value of the property.
     *
     * @param string $objectType   The object type.
     * @param string $storeCode    The store code.
     * @param string $id           The object ID.
     * @param string $propertyCode The property code to get value.
     *
     * @return mixed
     * @throws InvalidDataException Thrown property code is not found.
     */
    public static function getPropertyValue(string $objectType, string $storeCode, string $id, string $propertyCode);


    /**
     * Sets the value of the property.
     *
     * @param string $objectType   The object type.
     * @param string $storeCode    The store code.
     * @param string $id           The object ID.
     * @param string $propertyCode The property code to get value.
     * @param mixed  $value        The value to set.
     *
     * @return void
     * @throws InvalidDataException Thrown property code is not found.
     */
    public static function setPropertyValue(string $objectType, string $storeCode, string $id, string $propertyCode, $value);


    /**
     * Deletes the value of the property.
     *
     * @param string $objectType   The object type.
     * @param string $storeCode    The store code.
     * @param string $id           The object ID.
     * @param string $propertyCode The property code to delete value.
     *
     * @return mixed
     * @throws InvalidDataException Thrown property code is not found.
     */
    public static function deletePropertyValue(string $objectType, string $storeCode, string $id, string $propertyCode);


    /**
     * Returns a flat list of data record's children including their dataRecordid and level.
     *
     * @param string  $objectType The object type.
     * @param string  $storeCode  The store code.
     * @param string  $id         The object ID.
     * @param integer $depth      The max depth.
     *
     * @return array
     */
    public static function getChildren(string $objectType, string $storeCode, string $id, int $depth=null);


    /**
     * Returns a flat list of data record's parents.
     *
     * @param string  $objectType The object type.
     * @param string  $storeCode  The store code.
     * @param string  $id         The object ID.
     * @param integer $depth      The max depth.
     *
     * @return array
     */
    public static function getParents(string $objectType, string $storeCode, string $id, int $depth=null);


    /**
     * Checks if the store exists.
     *
     * @param string $name Name of the store.
     *
     * @return boolean
     */
    public static function getDataStoreExists(string $name);


    /**
     * Checks if the store exists.
     *
     * @param string $name Name of the store.
     *
     * @return boolean
     */
    public static function getUserStoreExists(string $name);


    /**
     * Create data record.
     *
     * @param string $storeCode The store code.
     * @param string $type      The data record type code.
     * @param string $parent    The ID of the parent data record.
     *
     * @return string
     * @throws InvalidDataException     Thrown when store code is not found.
     * @throws InvalidDataException     Thrown when parent data record is not found.
     * @throws InvalidArgumentException Thrown when parent data record ID is not valid.
     */
    public static function createDataRecord(string $storeCode, string $customType, string $parent=null);


    /**
     * Gets the data record type object.
     *
     * The result object should include 'id' and 'typeClass' fields: ['id' => ID, 'typeClass' => TYPE_CLASSNAME]
     *
     * @param string $storeCode The store code.
     * @param string $id        The ID of the data record.
     *
     * @return null|array
     * @throws InvalidDataException     Thrown when store code is not found.
     * @throws InvalidArgumentException Thrown when data record ID is not valid.
     */
    public static function getDataRecord(string $storeCode, string $id);


    /**
     * Return the data record type object that has the unique property value.
     *
     * The result object should include 'id' and 'typeClass' fields: ['id' => ID, 'typeClass' => TYPE_CLASSNAME]
     *
     * @param string $storeCode  The store code.
     * @param string $propertyid The ID of the unique property.
     * @param string $value      The value of the unique property.
     *
     * @return null|array
     * @throws InvalidArgumentException Thrown when value is not valid.
     * @throws InvalidDataException     Thrown when property code is not found.
     * @throws InvalidDataException     Thrown when non-unique property type is used.
     * @throws InvalidDataException     Thrown when store code is not found.
     */
    public static function getDataRecordByValue(string $storeCode, string $propertyid, string $value);


    /**
     * Creates a user and assign it to user groups. Returns created userid.
     *
     * @param string $storeCode The store code.
     * @param string $username  The username of user.
     * @param string $firstName User first name.
     * @param string $lastName  User last name.
     * @param string $type      User type code.
     *                          TODO: this is a palceholder until user types are implemented.
     * @param array  $groups    Optional. Parent user groups to assign the new user to. If left empty, user will be
     *                          created under root user group.
     *
     * @return string
     * @throws InvalidDataException     Thrown when store code is not found.
     * @throws InvalidDataException     Thrown when parent group belongs to different store.
     * @throws InvalidArgumentException Thrown when username is not valid.
     */
    public static function createUser(string $storeCode, string $username, string $firstName, string $lastName, string $type=null, array $groups=[]);


    /**
     * Creates a user group and assign it to user groups. Returns created user groupid.
     *
     * @param string $storeCode The store code.
     * @param string $groupName The name of user group.
     * @param string $type      User type code.
     *                          TODO: this is a palceholder until user types are implemented.
     * @param array  $groups    Optional. Parent user groups to assign the new user to. If left empty, user will be
     *                          created under root user group.
     *
     * @return string
     * @throws InvalidDataException     Thrown when store code is not found.
     * @throws InvalidDataException     Thrown when parent group belongs to different store.
     * @throws InvalidArgumentException Thrown when group name is not valid.
     */
    public static function createGroup(string $storeCode, string $groupName, string $type=null, array $groups=[]);


    /**
     * Gets a user group if it exists.
     *
     * @param string $storeCode The user stores code the group belongs to.
     * @param string $id        The id of the group.
     *
     * @return array|null
     * @throws InvalidDataException Thrown when store code is not found.
     */
    public static function getGroup(string $storeCode, string $id);


    /**
     * Gets a user from a user store by username.
     *
     * @param string $storeCode The user store's code.
     * @param string $username  The users username.
     *
     * @return array|null
     * @throws InvalidDataException Thrown when store code is not found.
     */
    public static function getUserByUsername(string $storeCode, string $username);


    /**
     * Gets a user from a user store by userid.
     *
     * The result array should include the following fields: [
     *  'id'        => USER_ENTITYID
     *  'username'  => USERNAME
     *  'typeClass' => null
     *  'groups'    => GROUP_ENTITYIDS
     *  'firstName' => FIRST_NAME
     *  'lastName'  => LAST_NAME
     * ]
     *
     * @param string $storeCode The user store's code.
     * @param string $id        The users id.
     *
     * @return array|null
     * @throws InvalidDataException Thrown when store code is not found.
     */
    public static function getUser(string $storeCode, string $id);


    /**
     * Returns the projects instance id.
     *
     * @return string
     */
    public static function getProjectInstanceID();

    /**
     * Login.
     *
     * @param object $user      The user we want to login.
     * @param string $storeCode The user store's code.
     *
     * @return boolean
     * @throws InvalidDataException Thrown when store code is not found.
     * @throws InvalidDataException Thrown when user is not found.
     */
    public static function login(string $id, string $storeCode);


    /**
     * Logout
     *
     * @return void
     */
    public static function logout();


    /**
     * Gets Authentication secret key.
     *
     * @return string|null
     */
    public static function getSecretKey();


    /**
     * Gets the current logged in user and their store.
     *
     * The returned array should include the same list of fields from getUser() + 'storeCode'.
     *
     * @return array|null
     */
    public static function getLoggedInUser();


    /**
     * Sends email.
     *
     * @param string $to      The to address.
     * @param string $from    The from address.
     * @param string $subject The subject of the email.
     * @param string $message The email content.
     *
     * @return boolean
     */
    public static function sendEmail(string $to, string $from, string $subject, string $message);


    /**
     * Returns the full namespaced class name.
     *
     * @param string $objectType The object type, eg. data.
     * @param string $type       The type of the object we are creating.
     *
     * @return string
     * @throws InvalidDataException Thrown when custom type does not exist.
     */
    public static function getCustomTypeClassByName(string $objectType, string $type);


    /**
     * Queue job.
     *
     * @param mixed    $queueNames      The queue name(s) to queue this job up with.
     * @param mixed    $jobData         The data for the job that is being queued.
     * @param callable $successCallback An optional callback we will call on successful creation of the job.
     * @param callable $failedCallback  An optional callback we will call on failure to create the job.
     *
     * @return void
     */
    public static function addQueueJob($queueNames, $data, callable $successCallback=null, callable $failedCallback=null);


    /**
     * Checks if the request is in the simulator.
     *
     * @return boolean
     */
    public static function isSimulated();


    /**
     * Returns true if the request is in a read-only mode.
     *
     * @return boolean
     */
    public static function isReadOnly();


    /**
     * Returns the project context of the project.
     *
     * @param string $namespace The namespace of the class trying to get the project context of.
     *
     * @return string
     */
    public static function getProjectContext(string $namespace);


    /**
     * Checks if the project existss.
     *
     * @param string $projectCode The code of the project.
     *
     * @return boolean
     */
    public static function projectExists(string $projectCode);


    /**
     * Returns list of files that have been autoloaded.
     *
     * @return array
     */
    public static function getAutoloadedFilepaths();


}//end interface
