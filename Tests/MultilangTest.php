<?php

namespace Agit\MultilangBundle\Tests;

use PHPUnit_Framework_TestCase;
use Agit\MultilangBundle\Multilang;

class MultilangTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerTestMultilangStringToArray
     */
    public function testMultilangStringToObject($string, $expected)
    {
        $this->assertEquals($expected, Multilang::multilangStringToArray($string));

    }

    /**
     * @dataProvider providerTestU
     */
    public function testU($string, $locale, $expected)
    {
        $this->assertEquals($expected, Multilang::u($string, $locale));
    }

    public function providerTestMultilangStringToArray()
    {
        return [
            ["[:de]irgendwas[:en]something", ["de" => "irgendwas", "en"=>"something"]],
            ["[:de][:en]something", ["de" => "", "en"=>"something"]],
            ["[de]irgendwas[:en]something", []],
            ["[deirgendwas[:en]something", []],
            ["[:deirgendwas[:en]something", []],
            ["something", []]
        ];
    }

    public function providerTestU()
    {
        return [
            ["[:de]irgendwas[:en]something", "de_DE", "irgendwas"],
            ["[:de]irgendwas", "de_DE", "irgendwas"],
            ["[:de][:en]something", "de_DE", ""],
            ["[de]irgendwas[:en]something", "de_DE", "[de]irgendwas[:en]something"],
            ["[:de]irgendwas[:en]something", "fr_FR", "something"],
            ["[:deirgendwas[:en]something", "en_GB", "[:deirgendwas[:en]something"],
            ["something", "de_DE", "something"],
        ];
    }
}
