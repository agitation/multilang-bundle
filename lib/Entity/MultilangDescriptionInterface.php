<?php
declare(strict_types=1);

/*
 * @package    agitation/multilang-bundle
 * @link       http://github.com/agitation/multilang-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\Entity;

interface MultilangDescriptionInterface
{
    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @return string $description
     */
    public function getDescription();
}
