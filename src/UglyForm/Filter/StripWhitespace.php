<?php
/**
 * User: garyhockin
 * Date: 31/12/2013
 * Time: 09:49
 */

namespace UglyForm\Filter;


/**
 * Class StripWhitespace
 * @package UglyForm\Filter
 */
class StripWhitespace implements FilterInterface
{
    /**
     * @param $value
     * @return string
     */
    public function filter($value)
    {
        return trim($value);
    }
} 