<?php
/**
 * Paml: PHP array markkup language.
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
}
