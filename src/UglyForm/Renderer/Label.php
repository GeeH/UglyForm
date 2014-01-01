<?php
/**
 * User: garyhockin
 * Date: 31/12/2013
 * Time: 11:08
 */

namespace UglyForm\Renderer;


use UglyForm\Form\Form;

class Label implements RendererInterface
{
    use RendererTrait;

    public function render(Form $form, $name, array $attributes = array())
    {
        $element = $form->getElement($name);
        $attributes = $this->mergeAttributes($form, $element, $attributes);

        $label = !is_null($element->getLabel()) ? $element->getLabel() : ucfirst($element->getName());
        $html = "<label for=\"{$attributes['id']}\">{$label}</label>";

        return $html;
    }
} 