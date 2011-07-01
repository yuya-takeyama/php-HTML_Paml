<?php
/**
 * Paml: PHP array markup language.
 *
 * @author Yuya Takeyama
 */

namespace HTML\Paml;

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
            $tag = $ary[0];
            $str = $ary[1];
            return "<{$tag}>{$str}</{$tag}>";
        }
    }
}
