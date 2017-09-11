<?php
declare(strict_types=1);
/*
 * @package    agitation/multilang-bundle
 * @link       http://github.com/agitation/multilang-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\Service;

use Agit\IntlBundle\Service\LocaleService;
use Agit\IntlBundle\Tool\Translate;

class MultilangString
{
    private $localeService;

    public function __construct(LocaleService $localeService)
    {
        $this->localeService = $localeService;
    }

    public function t($string)
    {
        return $this->getMultilangString(function () use ($string) {
            return Translate::t($string);
        });
    }

    public function x($context, $string)
    {
        return $this->getMultilangString(function () use ($context, $string) {
            return Translate::x($context, $string);
        });
    }

    public function n($string1, $string2, $num)
    {
        return $this->getMultilangString(function () use ($string1, $string2, $num) {
            return Translate::n($string1, $string2, $num);
        });
    }

    public function getMultilangString($callback)
    {
        $string = '';
        $oldLocale = $this->localeService->getLocale();

        foreach ($this->localeService->getAvailableLocales() as $locale)
        {
            $this->localeService->setLocale($locale);
            $lang = substr($locale, 0, 2);

            $translation = $callback($lang);
            $string .= "[:$lang]" . $translation;
        }

        $this->localeService->setLocale($oldLocale);

        return $string;
    }
}
