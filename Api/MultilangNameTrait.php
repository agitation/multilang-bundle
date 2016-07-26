<?php
/**
 * @package    agitation/api
 * @link       http://github.com/agitation/AgitApiBundle
 * @author     Alex Günsche <http://www.agitsol.com/>
 * @copyright  2012-2015 AGITsol GmbH
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\Api;

// Doctrine apparently needs the explicit import, so don't delete the following line.
use Agit\MultilangBundle\Api\MultilangStringType;
use Agit\ApiBundle\Annotation\Property;



trait MultilangNameTrait
{
    /**
     * @Property\Name("Name")
     * @MultilangStringType(minLength=3, maxLength=50)
     */
    public $name;
}
