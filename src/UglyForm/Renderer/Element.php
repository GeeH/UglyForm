<?php
/**
 * User: garyhockin
 * Date: 30/12/2013
 * Time: 11:26
 */

namespace UglyForm\Renderer;


use UglyForm\Form\Form;

/**
 * Class Element
 * @package UglyForm\Renderer
 */
class Element implements RendererInterface
{
    use RendererTrait;

    /**
     *  Default input type if none is given
     */
    const DEFAULT_INPUT_TYPE = 'text';

    /**
     * @param Form $form
     * @param $name
     * @param array $attributes
     * @return string
     */
    public function render(Form $form, $name, array $attributes = array())
    {
        $element = $form->getElement($name);

        $attributes = $this->mergeAttributes($form, $element, $attributes);

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