<?php
declare(strict_types=1);
/*
 * @package    agitation/multilang-bundle
 * @link       http://github.com/agitation/multilang-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\Entity;

use Agit\MultilangBundle\EntityConstraint\Multilang;
use Doctrine\ORM\Mapping as ORM;

trait MultilangDescriptionAwareTrait
{
    /**
     * @ORM\Column(type="text")
     * @Multilang(maxLength=300)
     */
    private $description;

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
