<?php
/**
 * User: garyhockin
 * Date: 01/01/2014
 * Time: 14:16
 */

namespace UglyForm\Renderer;

use UglyForm\Form\Form;

class Error implements RendererInterface
{
    use RendererTrait;

    const DEFAULT_ERROR_TAG = 'div';
    const DEFAULT_ERROR_MESSAGE = 'Validation Error';

    public function render(Form $form, $name, array $attributes = array())
    {
        $element = $form->getElement($name);

        if (!array_key_exists('tag', $attributes)) {
            $attributes['tag'] = self::DEFAULT_ERROR_TAG;
        }

        if (!array_key_exists('message', $attributes)) {
            $attributes['message'] = self::DEFAULT_ERROR_MESSAGE;
        }

        if ($element->isValid()) {
            return '';
        }

        $tag = $attributes['tag'];
        unset($attributes['tag']);

        $message = $attributes['message'];
        unset($attributes['message']);

        $html = "<{$tag} ";
        foreach ($attributes as $key => $value) {
            $html .= "{$key}=\"{$value}\" ";
        }

        $html = trim($html);

        $html .= ">{$message}</{$tag}>";
        return $html;
    }
} 