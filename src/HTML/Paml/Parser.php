<?php
/**
 * Paml: PHP array markup language.
 *
 * @author Yuya Takeyama
 */

namespace HTML\Paml;

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
    public function parse(array $ary)
    {
        if (count($ary) === 1) {
            return "<{$ary[0]} />";
        } else {
            return $this->_parseElement($ary);
        }
    }

    /**
     * Parses Paml element recursively.
     *
     * @param  array $ary
     * @return string
     */
    protected function _parseElement($ary)
    {
        $tag   = $ary[0];
        if (Util::isNumericArray($ary[1])) {
            $inner = $this->_parseElement($ary[1]);
        } else {
            $inner = $ary[1];
        }
        return "<{$tag}>{$inner}</{$tag}>";
    }
}
