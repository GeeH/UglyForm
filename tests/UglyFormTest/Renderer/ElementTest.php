<?php
/**
 * User: garyhockin
 * Date: 30/12/2013
 * Time: 11:33
 */

namespace FormTest\Renderer;

use UglyForm\Form\Form;

class ElementTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $form = new Form('testForm');
        $form->addElement('test');

        $renderer = new \UglyForm\Renderer\Element();

        $output = '<input name="test" value="" type="text" />';
        $this->assertEquals($output, $renderer->render($form, 'test'));

        $output = '<input name="test" value="" class="input" type="text" />';
        $this->assertEquals($output, $renderer->render($form, 'test', array('class' => 'input')));

        $form->setDefaultElementAttributes(
            array(
                'class' => 'class'
            )
        );
        $output = '<input name="test" value="" class="class" type="password" />';
        $this->assertEquals($output, $renderer->render($form, 'test', array('type' => 'password')));

        $output = '<input name="test" value="" class="input" type="password" />';
        $this->assertEquals($output, $renderer->render($form, 'test', array('class' => 'input', 'type' => 'password')));

    }

}
 