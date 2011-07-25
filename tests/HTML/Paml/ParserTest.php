<?php
namespace HTML\Paml;

require_once __DIR__ . '/../../test_helper.php';

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
        $this->assertSame(
            '<div />',
            $this->parser->parse(array('div'))->toString()
        );
    }

    /**
     * @test
     */
    public function parse_creates_a_tag_contains_string_from_array_with_2_elements()
    {
        $this->assertSame(
            '<div>Foo</div>',
            $this->parser->parse(array('div', 'Foo'))->toString()
        );
    }

    /**
     * @test
     */
    public function parse_creates_nested_tag_from_nested_array()
    {
        $this->assertSame(
            '<div><p>Foo</p></div>',
            $this->parser->parse(array('div', array('p', 'Foo')))->toString()
        );
    }

    /**
     * @test
     */
    public function parse_creates_tag_which_has_id_from_sharp_sign()
    {
        $this->assertSame(
            '<div id="bar">Foo</div>',
            $this->parser->parse(array('div#bar', 'Foo'))->toString()
        );
    }

    /**
     * @test
     */
    public function parse_creates_tag_which_has_many_children_if_it_has_many_arrays_as_child()
    {
        $this->assertSame(
            '<ul><li>Foo</li><li>Bar</li><li>Baz</li></ul>',
            $this->parser->parse(array(
                'ul',
                    array('li', 'Foo'),
                    array('li', 'Bar'),
                    array('li', 'Baz')
            ))->toString()
        );
    }
}
