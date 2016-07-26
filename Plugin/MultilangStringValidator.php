<?php

namespace Agit\MultilangBundle\Plugin;

use Agit\ValidationBundle\Exception\InvalidValueException;
use Agit\PluggableBundle\Strategy\Object\ObjectPlugin;
use Agit\PluggableBundle\Strategy\ServiceAwarePluginInterface;
use Agit\PluggableBundle\Strategy\ServiceAwarePluginTrait;
use Agit\IntlBundle\Translate;
use Agit\ValidationBundle\Plugin\AbstractValidator;
use Agit\MultilangBundle\Multilang;

/**
 * @ObjectPlugin(tag="agit.validation", id="multilang", depends={"@agit.intl.locale"})
 */
class MultilangStringValidator extends AbstractValidator implements ServiceAwarePluginInterface
{
    use ServiceAwarePluginTrait;

    public function validate($value, $minLength = null, $maxLength = null, $allowLinebreaks = false)
    {
        // make sure there are no untranslated parts at the beginning, unless the string is entirely empty
        if ($value !== "")
            $this->getValidator("regex")->validate($value, "|^\[:[a-z]{2}\]|");

        $availableLanguages = array_map(
            function($locale){ return substr($locale, 0, 2); },
            $this->getService("agit.intl.locale")->getAvailableLocales()
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
