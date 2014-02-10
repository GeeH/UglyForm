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
use UglyForm\Exception\FormElementException;

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
     * @var Object
     */
    protected $validator;
    /**
     * @var array
     */
    protected $filters = array();
    /**
     * @var bool
     */
    protected $valid;
    /**
     * @var bool
     */
    protected $filtered = false;
    /**
     * @var array
     */
    protected $attributes = array();
    /**
     * @var string
     */
    protected $label;

    /**
     * @param $name
     * @param string $tag
     */
    function __construct($name, $tag = 'input')
    {
        $this->setName($name);
        $this->setTag($tag);
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
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
     * @return bool
     * @throws \UglyForm\Exception\FormElementException
     */
    public function isValid()
    {

        if(is_null($this->getValidator())) {
            $this->valid = true;
        }

        if (!is_bool($this->valid)) {
            if (!method_exists($this->getValidator(), 'validate')) {
                throw new FormElementException('Validator `' . get_class(
                        $this->getValidator()
                    ) . '` does not have method `valid`');
            }
            $this->valid = $this->getValidator()->validate($this->getValue());
        }

        return $this->valid;
    }

    /**
     * @return \stdClass
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @param $validator
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

    /**
     * @return bool
     */
    public function filter()
    {
        if (!$this->filtered) {
            $wasFiltered = false;
            foreach ($this->getFilters() as $filter) {
                if (method_exists($filter, 'filter')) {
                    $wasFiltered = true;
                    $this->setValue($filter->filter($this->getValue()));
                }
            }
            $this->filtered = true;
        } else {
            $wasFiltered = false;
        }
        return $wasFiltered;
    }

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
} 