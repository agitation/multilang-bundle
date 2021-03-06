<?php
declare(strict_types=1);

/*
 * @package    agitation/multilang-bundle
 * @link       http://github.com/agitation/multilang-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\Api\Annotation;

use Agit\ApiBundle\Annotation\Property\StringType;

/**
 * @Annotation
 */
class MultilangStringType extends StringType
{
    public function check($value)
    {
        $this->init($value);

        if ($this->mustCheck())
        {
            static::$_validator->validate(
                'multilang',
                $value,
                $this->minLength,
                $this->maxLength,
                $this->allowLineBreaks
            );

            $this->checkForbiddenCharacters($value);
        }
    }
}
