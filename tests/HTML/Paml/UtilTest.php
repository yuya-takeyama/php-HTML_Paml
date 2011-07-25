<?php
namespace HTML\Paml;

require_once __DIR__ . '/../../test_helper.php';

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
}
