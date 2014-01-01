<?php
/**
 * User: garyhockin
 * Date: 30/12/2013
 * Time: 11:33
 */

namespace FormTest\Renderer;

use UglyForm\Form\Form;
use UglyForm\Renderer\Element;

class ElementTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $form = new Form('testForm');
        $form->addElement('test');

        $renderer = new Element();

        $output = '<input name="test" value="" type="text" id="testForm-test" />';
        $this->assertEquals($output, $renderer->render($form, 'test'));

        $output = '<input name="test" value="" type="text" id="testForm-test" class="input" />';
        $this->assertEquals($output, $renderer->render($form, 'test', array('class' => 'input')));

        $form->setDefaultElementAttributes(
            array(
                'class' => 'class'
            )
        );
        $output = '<input name="test" value="" class="input" type="password" id="testForm-test" />';
        $this->assertEquals($output, $renderer->render($form, 'test', array('type' => 'password')));

        $output = '<input name="test" value="" class="input" type="password" id="my-input" />';
        $this->assertEquals(
            $output,
            $renderer->render($form, 'test', array('id' => 'my-input', 'class' => 'input', 'type' => 'password'))
        );

    }

    public function testAttributesGetSet()
    {
        $form = new Form('testForm');
        $form->addElement('testElement');
        $renderer = new Element();
        $renderer->render($form, 'testElement', array('id' => 'testId'));
        $this->assertArrayHasKey('id', $form->getElement('testElement')->getattributes());
    }

}
 