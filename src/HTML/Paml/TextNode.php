<?php
/**
 * Paml: PHP array markup language.
 *
 * @author Yuya Takeyama
 */

namespace HTML\Paml;

use HTML\Paml\NodeInterface;
use HTML\Paml\Util;

/**
 * Class represents text node.
 *
 * @author Yuya Takeyama
 */
class TextNode implements NodeInterface
{
    /**
     * Node's text.
     *
     * @var string
     */
    protected $_text;

    /**
     * Constructor.
     *
     * @param string $text
     */
    public function __construct($text)
    {
        $this->_text = $text;
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
        return $this->_text;
    }
}
