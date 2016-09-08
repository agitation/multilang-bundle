<?php

namespace Agit\MultilangBundle;

use Agit\IntlBundle\Tool\Translate;

class Multilang
{
    static public function u($string, $locale = null)
    {
        if (!$locale)
            $locale = Translate::getLocale();

        $lang = substr($locale, 0, 2);
        $langs = self::multilangStringToArray($string);

        if (isset($langs[$lang]))
            $newString = $langs[$lang];
        elseif (isset($langs["en"]))
            $newString = $langs["en"];
        elseif (count($langs))
            $newString = reset($langs);
        else
            $newString = $string;

        return $newString;
    }

    static public function multilangStringToArray($string)
    {
        $langs = [];

        if (strpos($string, "[:") !== false && preg_match("|^\[:[a-z]{2}\]|", $string))
        {
            $parts = preg_split("|\[:([a-z]{2})\]|", $string, -1, PREG_SPLIT_DELIM_CAPTURE);

            // throw away (empty) first element and renumber.
            // NOTE: we can't use PREG_SPLIT_NO_EMPTY above, because it would break empty translations.
            array_shift($parts);
            $parts = array_values($parts);

            if (is_array($parts) && count($parts) >= 2)
                foreach ($parts as $k => $v)
                    if (!($k % 2) && $v && isset($parts[$k + 1]))
                        $langs[$v] = $parts[$k + 1];
        }

        return $langs;
    }
}
