<?php

/*
 * @package    agitation/multilang-bundle
 * @link       http://github.com/agitation/multilang-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\Service;

use Agit\MultilangBundle\Multilang;
use Twig_Extension;
use Twig_Function_Method;

class MultilangTwigExtension extends Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return ["u"  => new Twig_Function_Method($this, "u",  ["is_safe" => ["all"]])];
    }

    public function getName()
    {
        return "multilang";
    }

    public function u($string, $locale = null)
    {
        return Multilang::u($string, $locale);
    }
}
