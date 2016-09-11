<?php

/*
 * @package    agitation/multilang-bundle
 * @link       http://github.com/agitation/multilang-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\Entity;

use Agit\MultilangBundle\EntityConstraint\Multilang;
use Doctrine\ORM\Mapping as ORM;

trait MultilangNameAwareTrait
{
    /**
     * @ORM\Column(type="text")
     * @Multilang(minLength=2, maxLength=50)
     */
    private $name;

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
