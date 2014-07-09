<?php

namespace UglyForm\Renderer;


use UglyForm\Form\Form;

/**
 * Class Row
 * @package UglyForm\Renderer
 */
class Row implements RendererInterface
{
    use RendererTrait;

    /**
     * @var RendererInterface
     */
    protected $elementRenderer;
    /**
     * @var RendererInterface
     */
    protected $errorRenderer;
    /**
     * @var RendererInterface
     */
    protected $labelRenderer;
    /**
     * @var string
     */
    protected $wrapper = 'div';
    /**
     * @var array
     */
    protected $wrapperAttributes = array();
    /**
     * @var bool
     */
    protected $renderError = true;
    /**
     * @var bool
     */
    protected $renderLabel = true;
    /**
     * @var bool
     */
    protected $renderWrapper = true;
    /**
     * @var string
     */
    protected $errorClass = 'has-error';

    /**
     * @param Form $form
     * @param $name
     * @param array $attributes
     * @return mixed|void
     */
    public function render(Form $form, $name, array $attributes = array())
    {

        $html = '';
        $element = $form->getElement($name);
        $mergedAttributes = $this->mergeAttributes($form, $element, $attributes);


        if ($this->getRenderWrapper()) {
            $html .= "<{$this->getWrapper()} ";
            $wrapperAttributes = $this->getWrapperAttributes();
            if ($this->errorClass && !$element->isValid()) {
                $wrapperAttributes['class'] .= ' ' . $this->errorClass;
            }
            foreach ($wrapperAttributes as $key => $value) {
                $html .= "$key=\"$value\" ";
            }
            $html = rtrim($html);
            $html .= '>';
        }

        if ($this->getRenderError()) {
            $html .= $this->getErrorRenderer()->render($form, $name, $attributes);
        }

        if ($this->getRenderLabel()) {
            $html .= $this->getLabelRenderer()->render($form, $name, $attributes);
        }

        $html .= $this->getElementRenderer()->render($form, $name, $mergedAttributes);

        if ($this->renderWrapper) {
            $html .= "</{$this->wrapper}>";
        }

        return $html;
    }

    /**
     * @return boolean
     */
    public function getRenderWrapper()
    {
        return $this->renderWrapper;
    }

    /**
     * @param boolean $renderWrapper
     */
    public function setRenderWrapper($renderWrapper)
    {
        $this->renderWrapper = $renderWrapper;
    }

    /**
     * @return string
     */
    public function getWrapper()
    {
        return $this->wrapper;
    }

    /**
     * @param string $wrapper
     */
    public function setWrapper($wrapper)
    {
        $this->wrapper = $wrapper;
    }

    /**
     * @return array
     */
    public function getWrapperAttributes()
    {
        return $this->wrapperAttributes;
    }

    /**
     * @param array $wrapperAttributes
     */
    public function setWrapperAttributes($wrapperAttributes)
    {
        $this->wrapperAttributes = $wrapperAttributes;
    }

    /**
     * @return boolean
     */
    public function getRenderError()
    {
        return $this->renderError;
    }

    /**
     * @param boolean $renderError
     */
    public function setRenderError($renderError)
    {
        $this->renderError = $renderError;
    }

    /**
     * @return RendererInterface
     */
    public function getErrorRenderer()
    {
        if (is_null($this->errorRenderer)) {
            $this->setErrorRenderer(new Error());
        }
        return $this->errorRenderer;
    }

    /**
     * @param RendererInterface $errorRenderer
     */
    public function setErrorRenderer(RendererInterface $errorRenderer)
    {
        $this->errorRenderer = $errorRenderer;
    }

    /**
     * @return boolean
     */
    public function getRenderLabel()
    {
        return $this->renderLabel;
    }

    /**
     * @param boolean $renderLabel
     */
    public function setRenderLabel($renderLabel)
    {
        $this->renderLabel = $renderLabel;
    }

    /**
     * @return RendererInterface
     */
    public function getLabelRenderer()
    {
        if (is_null($this->labelRenderer)) {
            $this->setLabelRenderer(new Label());
        }
        return $this->labelRenderer;
    }

    /**
     * @param RendererInterface $labelRenderer
     */
    public function setLabelRenderer(RendererInterface $labelRenderer)
    {
        $this->labelRenderer = $labelRenderer;
    }

    /**
     * @return RendererInterface
     */
    public function getElementRenderer()
    {
        if (is_null($this->elementRenderer)) {
            $this->setElementRenderer(new Element());
        }
        return $this->elementRenderer;
    }

    /**
     * @param RendererInterface $elementRenderer
     */
    public function setElementRenderer(RendererInterface $elementRenderer)
    {
        $this->elementRenderer = $elementRenderer;
    }

} 