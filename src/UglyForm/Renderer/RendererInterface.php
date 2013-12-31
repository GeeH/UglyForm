<?php
/**
 * User: garyhockin
 * Date: 31/12/2013
 * Time: 08:59
 */

namespace UglyForm\Renderer;

use UglyForm\Form\Form;

/**
 * Interface RendererInterface
 * @package UglyForm\Renderer
 */
interface RendererInterface
{
    /**
     * @param Form $form
     * @param $name
     * @param array $attributes
     * @return mixed
     */
    public function render(Form $form, $name, array $attributes = array());
} 