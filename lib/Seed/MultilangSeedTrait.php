<?php

/*
 * @package    agitation/multilang-bundle
 * @link       http://github.com/agitation/multilang-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\Seed;
use Agit\BaseBundle\Exception\InternalErrorException;
use Agit\IntlBundle\Service\LocaleService;

trait MultilangSeedTrait
{
    /**
     * @param $callback string|callback
     */
    public function getMultilangString($callback)
    {
        $localeService = $this->getLocaleService();

        if (! ($localeService instanceof LocaleService))
            throw new InternalErrorException("This trait expects an instance of Agit\IntlBundle\Service\LocaleService.");

        $string = "";
        $oldLocale = $localeService->getLocale();

        foreach ($localeService->getAvailableLocales() as $locale)
        {
            $localeService->setLocale($locale);
            $lang = substr($locale, 0, 2);

            $translation = is_string($callback)
                ? $callback // make sure to use Translate::noop()
                : $callback($lang);

            $string .= "[:$lang]" . $translation;
        }

        $localeService->setLocale($oldLocale);

        return $string;
    }

    abstract protected function getLocaleService();
}
