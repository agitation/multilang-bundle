<?php

namespace Agit\MultilangBundle\Plugin;

use Agit\BaseBundle\Exception\InvalidValueException;
use Agit\BaseBundle\Service\LocaleService;
use Agit\BaseBundle\Tool\Translate;
use Agit\BaseBundle\Validation\AbstractValidator;
use Agit\BaseBundle\Validation\RegexValidator;
use Agit\MultilangBundle\Multilang;


class MultilangStringValidator extends AbstractValidator
{
    private $localeService;

    private $regexValidator;

    public function __construct(LocaleService $localeService, RegexValidator $regexValidator)
    {
        $this->localeService = $localeService;
        $this->regexValidator = $regexValidator;
    }

    public function validate($value, $minLength = null, $maxLength = null, $allowLinebreaks = false)
    {
        // make sure there are no untranslated parts at the beginning, unless the string is entirely empty
        if ($value !== "")
            $this->regexValidator->validate($value, "|^\[:[a-z]{2}\]|");

        $availableLanguages = array_map(
            function($locale){ return substr($locale, 0, 2); },
            $this->localeService->getAvailableLocales()
        );

        $parts = Multilang::multilangStringToArray($value);

        if (!count($parts) && $minLength)
            throw new InvalidValueException(Translate::t("The field must be translated into at least one language."));

        foreach ($parts as $lang => $string)
        {
            if (!in_array($lang, $availableLanguages))
            throw new InvalidValueException(sprintf(Translate::t("`%s` is not a valid language."), $lang));

            if ($string || $minLength)
                $this->getValidator("string")->validate($string, $minLength, $maxLength, $allowLinebreaks);
        }
    }
}
