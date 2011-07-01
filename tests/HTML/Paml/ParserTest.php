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
            $this->parser->parse(array('div'))
        );
    }

    /**
     * @test
     */
    public function parse_creates_a_tag_contains_string_from_array_with_2_elements()
    {
        $this->assertSame(
            '<div>Foo</div>',
            $this->parser->parse(array('div', 'Foo'))
        );
    }
}
