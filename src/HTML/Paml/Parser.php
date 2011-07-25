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
 */
class Parser
{
    public function parse(array $ary)
    {
        if (count($ary) === 1) {
            return "<{$ary[0]} />";
        } else {
            return $this->_parseElement($ary);
        }
    }

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

    protected function _isNumericArray($input)
    {
        if (is_array($input)) {
            foreach ($input as $key => $value) {
                if (! is_int($key)) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }
}
