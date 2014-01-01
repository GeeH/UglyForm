<?php
/**
 * User: garyhockin
 * Date: 01/01/2014
 * Time: 18:55
 */

namespace FormTest\Renderer;


use Respect\Validation\Validator;
use UglyForm\Form\Element;
use UglyForm\Form\Form;
use UglyForm\Renderer\Error;

class ErrorTest extends \PHPUnit_Framework_TestCase
{
    public function testRendererReturnsEmptyWhenValid()
    {
        $form = new Form('form');
        $element = $form->addElement('element');
        $element->setValidator(Validator::create()->alwaysValid());
        $renderer = new Error();

        $output = '';
        $this->assertEquals($output, $renderer->render($form, 'element'));
    }

    public function testRendererReturnsDefaultsWhenInvalid()
    {
        $form = new Form('form');
        $element = $form->addElement('element');
        $element->setValidator(Validator::create()->alwaysInvalid());
        $renderer = new Error();

        $output = '<div >Validation Error</div>';
        $this->assertEquals($output, $renderer->render($form, 'element'));
    }

    public function testRendererReturnsCorrectAttributes()
    {
        $form = new Form('form');
        $element = $form->addElement('element');
        $element->setValidator(Validator::create()->alwaysInvalid());
        $renderer = new Error();

        $attribute = array(
            'message' => 'Element must contain a chipmunk',
            'tag' => 'span',
            'class' => 'error-message',
        );

        $output = '<span class="error-message" >Element must contain a chipmunk</span>';
        $this->assertEquals($output, $renderer->render($form, 'element', $attribute));
    }
}
 