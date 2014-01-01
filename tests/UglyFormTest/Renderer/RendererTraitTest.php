<?php

namespace FormTest\Renderer;

use FormTest\Asset\RendererTraitAsset;
use UglyForm\Renderer\Element;
use UglyForm\Form\Form;

class RendererTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testMergeAssets()
    {
        $asset = new RendererTraitAsset();
        $form = new Form('form');
        $element = $form->addElement('element');
        $attributes = array('id' => 'attribute-id');

        $element->setattributes(
            array('class' => 'element-class', 'id' => 'element-id')
        );

        $form->setDefaultElementAttributes(array('class' => 'form-class'));

        $attributes = $asset->mergeAttributes($form, $element, $attributes);

        $this->assertCount(3, $attributes);

        $this->assertEquals('attribute-id', $attributes['id']);
        $this->assertEquals('element-class', $attributes['class']);
        $this->assertEquals(Element::DEFAULT_INPUT_TYPE, $attributes['type']);
    }
}
 