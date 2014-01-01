<?php

namespace FormTest\Renderer;


use UglyForm\Form\Form;
use UglyForm\Renderer\Label;

class LabelTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $form = new Form('testForm');
        $form->addElement('test')->setLabel('Test Element');

        $renderer = new Label();
        $output = '<label for="testForm-test">Test Element</label>';
        $this->assertEquals($output, $renderer->render($form, 'test'));
    }

    public function testLabelDefaultsToName()
    {
        $form = new Form('test');
        $form->addElement('pancake');

        $renderer = new Label();
        $output = '<label for="test-pancake">Pancake</label>';
        $this->assertEquals($output, $renderer->render($form, 'pancake'));
    }
}
 