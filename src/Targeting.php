<?php
/**
 * Targeting class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI;

/**
 * Targeting  class.
 */
class Targeting
{


    /**
     * Get a list of all perspectives that the current user has been placed into.
     *
     * Long Description
     *
     * @param array $limit A list of perspectives to limit the result to. If not specified, all active perspectives will
     *                     be returned.
     *
     * @return array
     */
    public static function getActivePerspectives(array $limit=null)
    {
        return \PerspectiveAPI\Connector::getActivePerspectives($limit);

    }//end getActivePerspectives()


    /**
     * Checks if the current user is in a list of perspectives.
     *
     * @param array|string $perspectives A list of perspectives to check if the user has been placed into. If only one
     *                                   perspective needs to be checked, a perspective string code can be passed.
     *
     * @return boolean
     */
    public static function isActivePerspective($perspectives)
    {
        return \PerspectiveAPI\Connector::isActivePerspective($perspectives);

    }//end isActivePerspective()


    /**
     * Expands a list of perspective categories into a list of perspective codes.
     *
     * @param array|string $categories A list of category names to expand.
     *
     * @return array
     */
    public static function expandPerspectiveCategory($categories=null)
    {
        return \PerspectiveAPI\Connector::expandPerspectiveCategory($categories);

    }//end expandPerspectiveCategory()


    /**
     * Returns the active language string.
     *
     * This function is intended to be used from inline PHP situation.
     *
     * @return string
     */
    public static function getActiveLanguage()
    {
        return \PerspectiveAPI\Connector::getActiveLanguage();

    }//end getActiveLanguage()


    /**
     * Returns true the passed language is the current language.
     *
     * @param string $languageid Languageid to check.
     *
     * @return boolean
     */
    public static function isActiveLanguage($languageid)
    {
        return \PerspectiveAPI\Connector::isActiveLanguage($languageid);

    }//end isActiveLanguage()


}//end class
