<?php
/**
 * Paml: PHP array markup language.
 *
 * @author Yuya Takeyama
 */

namespace HTML\Paml;

use HTML\Paml\Element;
use HTML\Paml\TextNode;
use HTML\Paml\Util;

/**
 * Paml parser.
 *
 * @author Yuya Takeyama
 */
class Parser
{
    /**
     * Parses array into HTML.
     *
     * @param  array $ary Paml formatted array.
     * @return string     Output HTML.
     */
    public function parse($paml)
    {
        if (is_array($paml)) {
            $factors = Util::extractSymbol($paml[0]);
            $element = new Element($factors);
            if (isset($paml[1])) {
                $element->appendChild($this->parse($paml[1]));
            }
            return $element;
        } else if (is_string($paml)) {
            return new TextNode($paml);
        }
    }
}
