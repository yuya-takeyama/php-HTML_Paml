<?php
/**
 * Paml: PHP array markup language.
 *
 * @author Yuya Takeyama
 */

namespace HTML\Paml;

use HTML\Paml\NodeInterface as Node;
use HTML\Paml\Util;

/**
 * Class represents HTML element.
 *
 * @author Yuya Takeyama
 */
class Element implements NodeInterface
{
    /**
     * HTML tag name.
     *
     * @var string
     */
    protected $_tag;

    /**
     * HTML attributes.
     *
     * @var array
     */
    protected $_attributes;

    /**
     * Child elements.
     *
     * @var array
     */
    protected $_children;

    /**
     * Constructor.
     *
     * @param array $params
     */
    public function __construct($params = array())
    {
        $this->_tag = isset($params['tag']) ? $params['tag'] : NULL;
        $this->_attributes = isset($params['attributes']) ? $params['attributes'] : array();
        if (isset($params['id'])) {
            $this->_attributes['id'] = $params['id'];
        }
        if (isset($params['class'])) {
            $this->_attributes['class'] = $params['class'];
        }
        $this->_children = array();
    }

    /**
     * Gets the tag name.
     *
     * @return string
     */
    public function getTagName()
    {
        return $this->_tag;
    }

    /**
     * Sets the attribute.
     *
     * @param  string $key   Attribute name.
     * @param  string $value Attribute value.
     */
    public function setAttribute($key, $value)
    {
        $this->_attributes[$key] = $value;
    }

    /**
     * Gets the attributes as hash.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->_attributes;
    }

    /**
     * Appends an element as a child.
     *
     * @param  HTML\Paml\Element
     * @return void
     */
    public function appendChild(Node $node)
    {
        $this->_children[] = $node;
    }

    /**
     * Whether the object has any child or not.
     *
     * @return bool
     */
    public function hasChild()
    {
        return count($this->_children) > 0;
    }

    /**
     * Gets the children nodes.
     *
     * @return array
     */
    public function getChildren()
    {
        return $this->_children;
    }

    /**
     * Converts to string.
     *
     * @return string
     */
    public function toString()
    {
        return $this->__toString();
    }

    /**
     * String representation of the object.
     *
     * @return string
     */
    public function __toString()
    {
        $result = "<{$this->getTagName()}";
        foreach ($this->getAttributes() as $key => $value) {
            $result .= " {$key}=\"" . Util::escape($value) . "\"";
        }
        if ($this->hasChild()) {
            $result .= '>';
            foreach ($this->getChildren() as $node) {
                $result .= $node->toString();
            }
            $result .= "</{$this->getTagName()}>";
        } else {
            $result .= ' />';
        }
        return $result;
    }
}
