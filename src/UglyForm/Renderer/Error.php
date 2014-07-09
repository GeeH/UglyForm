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

    /** default tag to render errors with */
    const DEFAULT_ERROR_TAG = 'div';
    /** default message to render if there is an error */
    const DEFAULT_ERROR_MESSAGE = 'Validation Error';

    public function render(Form $form, $name, array $attributes = array())
    {
        if (is_null($form->isValid()) || $form->isValid() || !$form->getPopulated()) {
            return false;
        }

        $element = $form->getElement($name);

        if (!array_key_exists('tag', $attributes) && !array_key_exists('tag', $this->getDefaultAttributes())) {
            $attributes['tag'] = self::DEFAULT_ERROR_TAG;
        }

        if (!array_key_exists('message', $attributes) && !array_key_exists('message', $this->getDefaultAttributes())) {
            $attributes['message'] = self::DEFAULT_ERROR_MESSAGE;
        }

        $attributes = $this->mergeAttributes(null, null, $attributes);

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