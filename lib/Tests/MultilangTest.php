<?php
declare(strict_types=1);
/*
 * @package    agitation/multilang-bundle
 * @link       http://github.com/agitation/multilang-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\MultilangBundle\Tests;

use Agit\MultilangBundle\Multilang;
use PHPUnit_Framework_TestCase;

class MultilangTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerTestMultilangStringToArray
     * @param mixed $string
     * @param mixed $expected
     */
    public function testMultilangStringToObject($string, $expected)
    {
        $this->assertSame($expected, Multilang::multilangStringToArray($string));
    }

    /**
     * @dataProvider providerTestU
     * @param mixed $string
     * @param mixed $locale
     * @param mixed $expected
     */
    public function testU($string, $locale, $expected)
    {
        $this->assertSame($expected, Multilang::u($string, $locale));
    }

    public function providerTestMultilangStringToArray()
    {
        return [
            ['[:de]irgendwas[:en]something', ['de' => 'irgendwas', 'en' => 'something']],
            ['[:de][:en]something', ['de' => '', 'en' => 'something']],
            ['[de]irgendwas[:en]something', []],
            ['[deirgendwas[:en]something', []],
            ['[:deirgendwas[:en]something', []],
            ['something', []]
        ];
    }

    public function providerTestU()
    {
        return [
            ['[:de]irgendwas[:en]something', 'de_DE', 'irgendwas'],
            ['[:de]irgendwas', 'de_DE', 'irgendwas'],
            ['[:de][:en]something', 'de_DE', ''],
            ['[de]irgendwas[:en]something', 'de_DE', '[de]irgendwas[:en]something'],
            ['[:de]irgendwas[:en]something', 'fr_FR', 'something'],
            ['[:deirgendwas[:en]something', 'en_US', '[:deirgendwas[:en]something'],
            ['something', 'de_DE', 'something'],
        ];
    }
}
