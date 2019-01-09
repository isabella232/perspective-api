<?php
/**
 * FileTrait.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Property;

/**
 * File Interface.
 */
interface FileInterface
{


    /**
     * Serve file type property content.
     *
     * When sendFileHeader() function is used in inline PHP code, it uses this action to send X-Sendfile
     * header for file type property. For any reason if it can't send header, then it returns false.
     *
     * @param string $shadowid The optional shadowid.
     *
     * @return void|boolean
     */
    public function sendFileHeader(string $shadowid=null);


}//end trait