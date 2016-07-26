<?php

namespace Agit\MultilangBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Agit\MultilangBundle\EntityConstraint\Multilang;

trait MultilangDescriptionAwareTrait
{
    /**
     * @ORM\Column(type="text")
     * @Multilang(maxLength=300)
     */
    private $description;

    /**
     * Set description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
