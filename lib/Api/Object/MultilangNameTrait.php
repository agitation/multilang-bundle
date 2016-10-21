<?php

/*
 * @package    agitation/multilang-bundle
 * @link       http://github.com/agitation/multilang-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\Api\Object;

// Doctrine apparently needs the explicit import, so don't delete the following line.
use Agit\ApiBundle\Annotation\Property;
use Agit\MultilangBundle\Api\Annotation\MultilangStringType;

trait MultilangNameTrait
{
    /**
     * @Property\Name("Name")
     * @MultilangStringType(minLength=3, maxLength=50)
     */
    public $name;
}
