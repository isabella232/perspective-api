<?php
/**
 * Init class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI;

/**
 * Init class.
 */
class Init
{


    /**
     * Sets class alias for Connector class.
     *
     * @param string $originalClass Fully namespaces class name to be an alias.
     *
     * @return boolean
     * @throws \Exception Thrown when original class does not exist.
     */
    final public static function setConnectorAlias(string $orignalClass)
    {
        if (class_exists($orignalClass) === false) {
            throw new \Exception('Failed to set Connector alias since the original class does not exist');
        }

        return class_alias($orignalClass, 'PerspectiveAPI\Connector');

    }//end setConnectorAlias()


    /**
     * Returns true if the id is in the correct format.
     *
     * @param string $id The ID to test validity.
     *
     * @return boolean
     */
    public static function isValidID(string $id)
    {
        if (preg_match('/^\d+(\.\d+)+$/', $id) === 1) {
            return true;
        }

        return false;

    }//end isValidID()


    /**
     * Validates a property code is in the right format.
     *
     * @param string $propertyCode The property code to validate.
     *
     * @return boolean
     * @throws \PerspectiveAPI\Exception\InvalidDataException When the property code is invalid.
     */
    public static function validatePropertyid(string $propertyCode)
    {
        $codeParts = explode('.', $propertyCode);
        if (count($codeParts) < 2) {
            throw new \PerspectiveAPI\Exception\InvalidDataException(sprintf('Propertyid (%s) is invalid', $propertyCode));
        }

        return true;

    }//end validatePropertyid();


}//end class
