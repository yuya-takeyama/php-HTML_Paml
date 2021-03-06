<?php
namespace HTML\Paml;

use HTML\Paml\Util;

/**
 * Test class for HTML\Paml\Parser.
 */
class UtilTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function isNumericArray_should_be_true_if_the_array_key_is_consists_of_numbers_only()
    {
        $this->assertTrue(Util::isNumericArray(array('Foo', 'Bar', 'Baz')));
    }

    /**
     * @test
     */
    public function isNumericArray_should_be_true_if_the_array_is_empty()
    {
        $this->assertTrue(Util::isNumericArray(array()));
    }

    /**
     * @test
     */
    public function isNumericArray_should_be_false_if_the_array_is_hash()
    {
        $this->assertFalse(Util::isNumericArray(array('Foo' => 'Bar')));
    }

    /**
     * @test
     */
    public function isNumericArray_should_be_false_if_the_array_has_string_key()
    {
        $this->assertFalse(Util::isNumericArray(array('Foo', 'Bar' => 'Baz')));
    }

    /**
     * @test
     */
    public function isNumericArray_should_be_false_if_the_argument_is_not_an_array()
    {
        $this->assertFalse(Util::isNumericArray(NULL));
    }

    /**
     * @test
     */
    public function extractSymbol_should_be_array_contains_only_array_if_the_symbol_does_not_contains_any_sharp_or_dots()
    {
        $this->assertSame(
            array('tag' => 'p'),
            Util::extractSymbol('p')
        );
    }

    /**
     * @test
     */
    public function extractSymbol_should_have_id_if_the_symbol_contains_a_sharp_sign()
    {
        $this->assertSame(
            array('tag' => 'p', 'id' => 'foo'),
            Util::extractSymbol('p#foo')
        );
    }

    /**
     * @test
     */
    public function extractSymbol_should_have_one_class_if_the_symbol_contains_a_dot_sign()
    {
        $this->assertSame(
            array('tag' => 'p', 'class' => 'foo'),
            Util::extractSymbol('p.foo')
        );
    }

    /**
     * @test
     */
    public function extractSymbol_should_have_three_classes_if_the_symbol_contains_3_dots()
    {
        $this->assertSame(
            array('tag' => 'p', 'class' => 'foo bar baz'),
            Util::extractSymbol('p.foo.bar.baz')
        );
    }

    /**
     * @test
     */
    public function extractSymbol_should_have_id_and_classes_if_both_of_them_are_included()
    {
        $this->assertSame(
            array('tag' => 'p', 'id' => 'hoge', 'class' => 'foo bar baz'),
            Util::extractSymbol('p#hoge.foo.bar.baz')
        );
    }

    /**
     * @test
     */
    public function extractSymbol_should_have_div_as_tag_if_symbol_contains_no_tag()
    {
        $this->assertSame(
            array('tag' => 'div', 'id' => 'hoge', 'class' => 'foo bar baz'),
            Util::extractSymbol('#hoge.foo.bar.baz')
        );
    }

    /**
     * @test
     */
    public function extractSymbol_should_be_able_to_extract_h1_tag()
    {
        $this->assertSame(
            array('tag' => 'h1', 'id' => 'hoge', 'class' => 'foo bar baz'),
            Util::extractSymbol('h1#hoge.foo.bar.baz')
        );
    }

    /**
     * @test
     */
    public function extractNumericArray_should_return_the_argument_if_it_is_numeric_array()
    {
        $numericArray = array('Foo', 'Bar', 'Baz');
        $this->assertSame($numericArray, Util::extractNumericArray($numericArray));
    }

    /**
     * @test
     */
    public function extractNumericArray_should_return_empty_array_if_the_argument_is_hash()
    {
        $hash = array('foo' => 'bar', 'hoge' => 'piyo');
        $this->assertSame(array(), Util::extractNumericArray($hash));
    }

    /**
     * @test
     */
    public function extractNumericArray_should_return_numeric_array_extracted_from_the_argument()
    {
        $input = array('Foo', 'Bar', 'Baz', 'hoge' => 'piyo', 'fuga' => 'hage');
        $this->assertSame(
            array('Foo', 'Bar', 'Baz'),
            Util::extractNumericArray($input)
        );
    }

    /**
     * @test
     */
    public function extractHash_should_return_the_argument_if_it_is_hash()
    {
        $hash = array('foo' => 'bar', 'hoge' => 'piyo');
        $this->assertSame($hash, Util::extractHash($hash));
    }

    /**
     * @test
     */
    public function extractHash_should_return_empty_array_if_the_argument_is_numeric_array()
    {
        $numericArray = array('Foo', 'Bar', 'Baz');
        $this->assertSame(array(), Util::extractHash($numericArray));
    }

    /**
     * @test
     */
    public function extractHash_should_return_hash_extracted_from_the_argument()
    {
        $input = array('Foo', 'Bar', 'Baz', 'hoge' => 'piyo', 'fuga' => 'hage');
        $this->assertSame(
            array('hoge' => 'piyo', 'fuga' => 'hage'),
            Util::extractHash($input)
        );
    }
}
