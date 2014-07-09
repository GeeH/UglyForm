<?php
/**
 * User: garyhockin
 * Date: 01/01/2014
 * Time: 13:11
 */

namespace UglyForm\Renderer;

/**
 * Class RendererTrait
 * @package UglyForm\Renderer
 */
trait RendererTrait
{

    /**
     * @var array
     */
    protected $defaultAttributes = array();
    /**
     * Tags that don't need a closing tag and can be opened with />
     *
     * @var array
     */
    protected $inLineTags = array('button', 'submit', 'textarea');

    /**
     * @param \UglyForm\Form\Form $form
     * @param \UglyForm\Form\Element $element
     * @param array $attributes
     * @param bool $pushBack
     * @return array
     */
    public function mergeAttributes(
        \UglyForm\Form\Form $form = null,
        \UglyForm\Form\Element $element = null,
        array $attributes = null,
        $pushBack = true
    ) {

        is_null($form) ? $formArray = array() : $formArray = $form->getDefaultElementAttributes();
        is_null($element) ? $elementArray = array() : $elementArray = $element->getAttributes();
        is_null($attributes) ? $attributeArray = array() : $attributeArray = $attributes;

        $attributes = array_merge(
            $formArray,
            $elementArray,
            $this->getDefaultAttributes(),
            $attributeArray
        );

        if (!array_key_exists('type', $attributes) && !is_null($element)) {
            $attributes['type'] = constant(
                'UglyForm\Renderer\Element::DEFAULT_' . strtoupper($element->getTag()) . '_TYPE'
            );
        }

        if (!array_key_exists('id', $attributes) && !is_null($form)) {
            $attributes['id'] = $form->getName() . '-' . $element->getName();
        }

        if ($pushBack && !is_null($element)) {
            $element->setattributes($attributes);
        }

        return $attributes;
    }

    /**
     * @return array
     */
    public function getDefaultAttributes()
    {
        return $this->defaultAttributes;
    }

    /**
     * @param array $defaultAttributes
     */
    public function setDefaultAttributes(array $defaultAttributes)
    {
        $this->defaultAttributes = $defaultAttributes;
    }
} 