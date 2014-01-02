<?php

namespace UglyForm\Form;

use UglyForm\Exception\FormElementException;

/**
 * Class Form
 * @package UglyForm\Form
 */
class Form
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var Element[]
     */
    protected $elements = array();
    /**
     * @var array
     */
    protected $defaultElementAttributes = array();
    /**
     * @var bool
     */
    protected $valid;

    /**
     * @param $name
     */
    function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * @return array
     */
    public function getDefaultElementAttributes()
    {
        return $this->defaultElementAttributes;
    }

    /**
     * @param array $defaultElementAttributes
     */
    public function setDefaultElementAttributes(array $defaultElementAttributes)
    {
        $this->defaultElementAttributes = $defaultElementAttributes;
    }

    /**
     * @param $name
     * @param string $tag
     * @return Element
     * @throws \UglyForm\Exception\FormElementException
     */
    public function addElement($name, $tag = 'input')
    {
        if ($this->elementExists($name)) {
            throw new FormElementException("An element by the name `$name` already exists");
        }
        $element = new Element($name, $tag);
        $this->elements[] = $element;

        return $element;
    }

    /**
     * @param $name
     * @return bool
     */
    public function elementExists($name)
    {
        foreach ($this->elements as $element) {
            if ($element->getName() === $name) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $name
     * @return Element
     * @throws \UglyForm\Exception\FormElementException
     */
    public function getElement($name)
    {
        foreach ($this->elements as $element) {
            if ($element->getName() === $name) {
                return $element;
            }
        }
        throw new FormElementException("Element `$name` does not exist`");
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
     * @return bool
     */
    public function isValid()
    {
        if (!is_bool($this->valid)) {
            $isValid = true;
            foreach ($this->getElements() as $element) {
                if (!$element->isValid()) {
                    $isValid = false;
                }
            }
            $this->valid = $isValid;
        }
        return $this->valid;
    }

    /**
     * @return Element[]
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param array $data
     */
    public function loadData(array $data)
    {
        foreach($data as $name => $value) {
            $this->getElement($name)->setValue($value);
        }
    }

    /**
     * @return array
     */
    public function getValues()
    {
        $values = array();
        foreach($this->getElements() as $element)
        {
            $values[$element->getName()] = $element->getValue();
        }
        return $values;
    }
} 