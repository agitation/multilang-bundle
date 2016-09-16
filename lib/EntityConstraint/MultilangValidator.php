<?php

/*
 * @package    agitation/multilang-bundle
 * @link       http://github.com/agitation/multilang-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\EntityConstraint;

use Agit\ValidationBundle\ValidationService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MultilangValidator extends ConstraintValidator
{
    private $validator;

    public function __construct(ValidationService $validator)
    {
        $this->validator = $validator;
    }

    public function validate($value, Constraint $constraint)
    {
        return $this->validator->isValid(
            "multilang",
            $value,
            $constraint->minLength,
            $constraint->maxLength,
            $constraint->allowLinebreaks
        );
    }
}
