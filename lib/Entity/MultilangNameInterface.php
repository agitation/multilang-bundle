<?php
declare(strict_types=1);

/*
 * @package    agitation/multilang-bundle
 * @link       http://github.com/agitation/multilang-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\Entity;

use Agit\BaseBundle\Entity\NameInterface;

interface MultilangNameInterface extends NameInterface
{
    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string $name
     */
    public function getName();
}
