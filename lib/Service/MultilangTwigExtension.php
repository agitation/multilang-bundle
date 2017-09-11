<?php
declare(strict_types=1);
/*
 * @package    agitation/multilang-bundle
 * @link       http://github.com/agitation/multilang-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\Service;

use Agit\MultilangBundle\Multilang;
use Twig_Extension;
use Twig_SimpleFunction;

class MultilangTwigExtension extends Twig_Extension
{
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('u', [$this, 'u'], ['is_safe' => ['all']])
        ];
    }

    public function getName()
    {
        return 'multilang';
    }

    public function u($string, $locale = null)
    {
        return Multilang::u($string, $locale);
    }
}
