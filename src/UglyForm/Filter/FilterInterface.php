<?php

namespace UglyForm\Filter;


/**
 * Interface FilterInterface
 * @package UglyForm\Filter
 */
interface FilterInterface
{
    /**
     * @param $value
     * @return mixed
     */
    public function filter($value);
} 