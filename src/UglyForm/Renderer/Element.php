<?php
/**
 * User: garyhockin
 * Date: 30/12/2013
 * Time: 11:26
 */

namespace UglyForm\Renderer;


use UglyForm\Form\Form;

class Element implements RendererInterface
{
    const DEFAULT_INPUT_TYPE = 'text';

    public function render(Form $form, $name, array $attributes = array())
    {
        $element = $form->getElement($name);
        $attributes = array_merge($form->getDefaultElementAttributes(), $attributes);

        if (!array_key_exists('type', $attributes)) {
            $attributes['type'] = constant('self::DEFAULT_' . strtoupper($element->getTag()) . '_TYPE');
        }

        $html = "<{$element->getTag()} "
            . "name=\"{$element->getName()}\" "
            . "value=\"{$element->getValue()}\" ";

        foreach ($attributes as $key => $value) {
            $html .= "{$key}=\"{$value}\" ";
        }

        $html .= '/>';

        return $html;
    }
} 