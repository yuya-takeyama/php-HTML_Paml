<?php
namespace HTML\Paml;

use HTML\Paml\Parser;

/**
 * Test class for HTML\Paml\Parser.
 */
class ParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HTML\Paml\Parser
     */
    protected $parser;

    public function setUp()
    {
        $this->parser = new Parser;
    }

    /**
     * @test
     */
    public function parse_creates_an_empty_tag_from_array_with_1_element()
    {
        $this->assertSameAsString(
            '<div />',
            $this->parser->parse(array('div'))
        );
    }

    /**
     * @test
     */
    public function parse_creates_a_tag_contains_string_from_array_with_2_elements()
    {
        $this->assertSameAsString(
            '<div>Foo</div>',
            $this->parser->parse(array('div', 'Foo'))
        );
    }

    /**
     * @test
     */
    public function parse_should_not_escape_its_inner_text_as_html()
    {
        $this->assertSameAsString(
            '<div>Foo<br />Bar</div>',
            $this->parser->parse(array('div', 'Foo<br />Bar'))
        );
    }

    /**
     * @test
     */
    public function parse_creates_nested_tag_from_nested_array()
    {
        $this->assertSameAsString(
            '<div><p>Foo</p></div>',
            $this->parser->parse(array('div', array('p', 'Foo')))
        );
    }

    /**
     * @test
     */
    public function parse_creates_tag_which_has_id_from_sharp_sign()
    {
        $this->assertSameAsString(
            '<div id="bar">Foo</div>',
            $this->parser->parse(array('div#bar', 'Foo'))
        );
    }

    /**
     * @test
     */
    public function parse_creates_tag_which_has_many_children_if_it_has_many_arrays_as_child()
    {
        $this->assertSameAsString(
            '<ul><li>Foo</li><li>Bar</li><li>Baz</li></ul>',
            $this->parser->parse(array(
                'ul',
                    array('li', 'Foo'),
                    array('li', 'Bar'),
                    array('li', 'Baz')
            ))
        );
    }

    /**
     * @test
     */
    public function parse_should_parse_array_mixed_with_hash()
    {
        $this->assertSameAsString(
            '<div id="foo" class="bar">Hoge</div>',
            $this->parser->parse(array(
                'div',
                'Hoge',
                'id'    => 'foo',
                'class' => 'bar',
            ))
        );
    }

    /**
     * @test
     * @expectedException HTML\Paml\Exception\ParseException
     */
    public function parse_should_throw_ParseException_if_the_argument_is_not_array_or_string()
    {
        $this->parser->parse(NULL);
    }

    /**
     * @test
     */
    public function parseFromString_evaluates_string_and_parse_as_paml_formatted_array()
    {
        $this->assertSameAsString(
            '<div />',
            $this->parser->parseFromString('["div"]')
        );
    }

    /**
     * @test
     * @expectedException HTML\Paml\Exception\EvalException
     */
    public function parseFromString_should_EvalException_if_the_string_is_unexpected()
    {
        $this->parser->parseFromString('["div');
    }

    /**
     * Assertion method to compare a string with an object has __toString() method.
     *
     * @param  string $expected Expected string.
     * @param  object $actual   Actual object which has __toStrin() method.
     * @param  string $message  Assertion message.
     */
    public function assertSameAsString()
    {
        $args = func_get_args();
        $args[1] = $this->_stringify($args[1]);
        call_user_func_array(array($this, 'assertSame'), $args);
    }

    /**
     * Stringify object.
     *
     * @param  object $obj
     * @return string
     */
    protected function _stringify($obj)
    {
        if (is_object($obj) && method_exists($obj, '__toString')) {
            return $obj->__toString();
        }
    }
}
