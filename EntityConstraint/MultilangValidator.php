<?php

namespace Agit\MultilangBundle\EntityConstraint;

use Exception;
use Agit\IntlBundle\Translate;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Agit\ValidationBundle\Service\ValidationService;

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
