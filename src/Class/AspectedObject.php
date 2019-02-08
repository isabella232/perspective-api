<?php
/**
 * AbstractObject base class.
 *
 * @package    Perspective
 * @subpackage API
 * @author     Squiz Pty Ltd <products@squiz.net>
 * @copyright  2019 Squiz Pty Ltd (ABN 77 084 670 600)
 */

namespace PerspectiveAPI\Class;

use \PerspectiveAPI\Class\AbstractObject as AbstractObject;

/**
 * DataRecord Class.
 */
abstract class AspectedObject extends AbstractObject
{


    /**
     * The aspect to query data record properties.
     *
     * @var array
     */
    protected $aspect = null;


    /**
     * Set aspect to query properties with.
     *
     * @param array $aspect The property aspect.
     *
     * @return void
     */
    final public function setAspect(array $aspect=null)
    {
        $this->aspect = $aspect;

    }//end setAspect()


    /**
     * Get aspect to query properties with.
     *
     * @return array
     */
    final public function getAspect()
    {
        return $this->aspect;

    }//end getAspect()


}//end class
