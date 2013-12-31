<?php
/**
 * User: garyhockin
 * Date: 30/12/2013
 * Time: 08:51
 */

namespace UglyForm\Form;


/**
 * Class Element
 * @package UglyForm\Form
 */
use Respect\Validation\Validator;

/**
 * Class Element
 * @package UglyForm\Form
 */
class Element
{
    /**
     * @var
     */
    protected $name;
    /**
     * @var string
     */
    protected $tag = 'input';
    /**
     * @var string
     */
    protected $value = '';
    /**
     * @var Validator
     */
    protected $validator;
    /**
     * @var array
     */
    protected $filters = array();

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * @param $filter
     */
    public function addFilter($filter)
    {
        $this->filters[] = $filter;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return \Respect\Validation\Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @param \Respect\Validation\Validator $validator
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
} 