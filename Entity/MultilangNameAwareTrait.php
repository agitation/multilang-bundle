<?php

namespace Agit\MultilangBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Agit\MultilangBundle\EntityConstraint\Multilang;

trait MultilangNameAwareTrait
{
    /**
     * @ORM\Column(type="text")
     * @Multilang(minLength=2, maxLength=50)
     */
    private $name;

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
