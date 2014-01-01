<?php
/**
 * User: garyhockin
 * Date: 01/01/2014
 * Time: 13:11
 */

namespace UglyForm\Renderer;

use UglyForm\Form\Element;
use UglyForm\Form\Form;

/**
 * Class RendererTrait
 * @package UglyForm\Renderer
 */
trait RendererTrait
{
    /**
     * @param Form $form
     * @param Element $element
     * @param array $attributes
     * @param bool $pushBack
     * @return array
     */
    public function mergeAttributes(Form $form, Element $element, array $attributes, $pushBack = true)
    {
        $attributes = array_merge($form->getDefaultElementAttributes(), $element->getattributes(), $attributes);

        if (!array_key_exists('type', $attributes)) {
            $attributes['type'] = constant(
                'UglyForm\Renderer\Element::DEFAULT_' . strtoupper($element->getTag()) . '_TYPE'
            );
        }

        if (!array_key_exists('id', $attributes)) {
            $attributes['id'] = $form->getName() . '-' . $element->getName();
        }

        if ($pushBack) {
            $element->setattributes($attributes);
        }

        return $attributes;
    }
} 