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
use HTML\Paml\Exception\ParseException;

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
            $count = count($paml);
            for ($i = 1; $i < $count; $i++) {
                $element->appendChild($this->parse($paml[$i]));
            }
            return $element;
        } else if (is_string($paml)) {
            return new TextNode($paml);
        }
        throw new ParseException;
    }
}
