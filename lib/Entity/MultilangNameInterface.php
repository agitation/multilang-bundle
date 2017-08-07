<?php

/*
 * @package    agitation/multilang-bundle
 * @link       http://github.com/agitation/multilang-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\Entity;

interface MultilangNameInterface
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
