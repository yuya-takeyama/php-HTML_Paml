<?php
namespace HTML\Paml;

use HTML\Paml\Element;

/**
 * Test class for HTML\Paml\Parser.
 */
class ElementTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function getTagName_should_be_its_tag_name()
    {
        $element = new Element(array('tag' => 'div'));
        $this->assertSame('div', $element->getTagName());
    }

    /**
     * @test
     */
    public function toString_should_be_tag_with_no_inner_node_if_it_is_not_specified()
    {
        $element = new Element(array('tag' => 'div'));
        $this->assertSame(
            '<div />',
            $element->toString()
        );
    }

    /**
     * @test
     */
    public function toString_should_be_tag_with_id_attribute_if_it_is_specified()
    {
        $element = new Element(array('tag' => 'div', 'id' => 'foo'));
        $this->assertSame(
            '<div id="foo" />',
            $element->toString()
        );
    }

    /**
     * @test
     */
    public function toString_should_be_tag_with_class_attribute_if_it_is_specified()
    {
        $element = new Element(array('tag' => 'div', 'class' => 'foo'));
        $this->assertSame(
            '<div class="foo" />',
            $element->toString()
        );
    }

    /**
     * @test
     */
    public function toString_should_be_tag_with_text_it_it_has_TextNode_as_a_child()
    {
        $element = new Element(array('tag' => 'p'));
        $textNode = new TextNode('some text');
        $element->appendChild($textNode);
        $this->assertSame(
            '<p>some text</p>',
            $element->toString()
        );
    }

    /**
     * @test
     */
    public function toString_should_be_tag_with_one_children_if_it_has_one_child_node()
    {
        $element = new Element(array('tag' => 'div'));
        $child = new Element(array('tag' => 'hr'));
        $element->appendChild($child);
        $this->assertSame(
            '<div><hr /></div>',
            $element->toString()
        );
    }

    /**
     * @test
     */
    public function hasChild_should_be_false_if_it_has_no_children()
    {
        $element = new Element(array('tag' => 'div'));
        $this->assertFalse($element->hasChild());
    }

    /**
     * @test
     */
    public function hasChild_should_be_true_if_it_has_node_as_its_child()
    {
        $element = new Element(array('tag' => 'div'));
        $child = new Element(array('tag' => 'div'));
        $element->appendChild($child);
        $this->assertTrue($element->hasChild());
    }
}
