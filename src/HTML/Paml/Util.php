<?php
/**
 * Paml: PHP array markup language.
 *
 * @author Yuya Takeyama
 */

namespace HTML\Paml;

/**
 * Utility methods.
 *
 * @author Yuya Takeyama
 */
class Util
{
    /**
     * Whether the argument is an array which key consists of only numbers.
     *
     * @param  array $input
     * @return bool
     */
    public static function isNumericArray($input)
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

    /**
     * Extracts a symbol into tag, id and classes.
     *
     * @param  string
     * @return array
     */
    public static function extractSymbol($symbol)
    {
        preg_match('/^([a-z]+)?(?:#([a-z\-_]+))?(?:\.([a-z\-_\.]+))?$/i', $symbol, $matches);
        if (isset($matches[1]) && strlen($matches[1]) > 0) {
            $result = array('tag' => $matches[1]);
        } else {
            $result = array('tag' => 'div');
        }
        if (isset($matches[2]) && strlen($matches[2]) > 0) {
            $result['id'] = $matches[2];
        }
        if (isset($matches[3])) {
            $result['class'] = join(' ', explode('.', $matches[3]));
        }
        return $result;
    }

    /**
     * Escapes string as HTML.
     *
     * @return string
     */
    public static function escape($str)
    {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}
