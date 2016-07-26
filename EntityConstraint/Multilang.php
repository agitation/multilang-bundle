<?php

namespace Agit\MultilangBundle\EntityConstraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Multilang extends Constraint
{
    // minimum length of the text in each language
    public $minLength = null;

    // maximum length of the text in each language
    public $maxLength = null;

    // allow tabs and line breaks
    public $allowLinebreaks = false;

    public function validatedBy()
    {
        return "multilang";
    }
}
