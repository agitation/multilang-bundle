<?php

namespace Agit\MultilangBundle\Service;

use Twig_Extension;
use Twig_Function_Method;
use Agit\MultilangBundle\Multilang;

class MultilangTwigExtension extends Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [ "u"  => new Twig_Function_Method($this, "u",  ["is_safe" => ["all"]]) ];
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
