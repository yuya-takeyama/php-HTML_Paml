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
use HTML\Paml\Exception\EvalException;

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
            $arr  = Util::extractNumericArray($paml);
            $hash = Util::extractHash($paml);

            $factors = Util::extractSymbol($arr[0]);
            $element = new Element($factors);
            $count = count($arr);
            for ($i = 1; $i < $count; $i++) {
                $element->appendChild($this->parse($paml[$i]));
            }
            foreach ($hash as $key => $value) {
                $element->setAttribute($key, $value);
            }
            return $element;
        } else if (is_string($paml)) {
            return new TextNode($paml);
        }
        throw new ParseException;
    }

    /**
     * Parses string as Paml.
     *
     * @param  string $pamlString
     * @return HTML\Paml\Element
     */
    public function parseFromString($pamlString)
    {
        if (@eval("\$paml = {$pamlString};") === false) {
            throw new EvalException;
        }
        return $this->parse($paml);
    }
}
