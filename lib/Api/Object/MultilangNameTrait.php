<?php
declare(strict_types=1);

/*
 * @package    agitation/multilang-bundle
 * @link       http://github.com/agitation/multilang-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\Api\Object;

// Doctrine apparently needs the explicit import, so don't delete the following line.
use Agit\MultilangBundle\Api\Annotation\MultilangStringType;

trait MultilangNameTrait
{
    /**
     * @MultilangStringType(minLength=3, maxLength=50)
     */
    public $name;
}
