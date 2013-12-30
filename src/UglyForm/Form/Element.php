<?php
/**
 * User: garyhockin
 * Date: 30/12/2013
 * Time: 08:51
 */

namespace UglyForm\Form;


class Element 
{
    protected $name;
    protected $type;
    protected $class;
    protected $attributes = array();
    protected $validators = array();
    protected $filters = array();
} 