<?php
/**
 * User: garyhockin
 * Date: 01/01/2014
 * Time: 18:55
 */

namespace FormTest\Renderer;

use Respect\Validation\Validator;
use UglyForm\Form\Form;
use UglyForm\Renderer\Label;
use UglyForm\Renderer\Row;

class RowTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Row
     */
    protected $renderer;

    public function setUp()
    {
        $this->renderer = new Row();
    }

    public function testSetLabelRenderer()
    {
        $this->renderer->setLabelRenderer(new Label());
        $this->assertInstanceOf('UglyForm\Renderer\Label', $this->renderer->getLabelRenderer());
    }

    public function testRenderingJustElement()
    {
        $form = new Form('test');
        $form->addElement('username');
        $this->renderer->setRenderWrapper(false);
        $this->renderer->setRenderLabel(false);
        $this->renderer->setRenderError(false);

        $output = '<input name="username" value="" type="text" id="test-username" />';
        $this->assertEquals($output, $this->renderer->render($form, 'username'));
    }

    public function testRenderingWithDefaults()
    {
        $form = new Form('test');
        $form->addElement('username');
        $this->renderer->setWrapperAttributes(array('class' => 'test'));
        $this->renderer->setRenderLabel(false);
        $this->renderer->setRenderError(false);

        $output = '<div class="test"><input name="username" value="" type="text" id="test-username" /></div>';
        $this->assertEquals($output, $this->renderer->render($form, 'username'));
    }

    public function testRenderingWithErrorRendererAndNoErrors()
    {
        $form = new Form('test');
        $form->addElement('username');
        $this->renderer->setWrapperAttributes(array('class' => 'test'));
        $this->renderer->setRenderLabel(false);
        $this->renderer->setRenderError(true);

        $output = '<div class="test"><input name="username" value="" type="text" id="test-username" /></div>';
        $this->assertEquals($output, $this->renderer->render($form, 'username'));
    }

    public function testRenderingWithErrorRendererAndErrors()
    {
        $form = new Form('test');
        $username = $form->addElement('username');
        $username->setValidator(
            Validator::create()->alwaysInvalid()
        );
        $this->renderer->setWrapperAttributes(array('class' => 'test'));
        $this->renderer->setRenderLabel(false);
        $this->renderer->setRenderError(true);

        $output = '<div class="test"><div>Validation Error</div><input name="username" value="" type="text" id="test-username" /></div>';
        $this->assertEquals($output, $this->renderer->render($form, 'username'));
    }

    public function testRenderingWithLabelEnabled()
    {
        $form = new Form('test');
        $username = $form->addElement('username');

        $this->renderer->setRenderWrapper(false);
        $this->renderer->setRenderLabel(true);
        $this->renderer->setRenderError(true);

        $output = '<label for="test-username">Username</label><input name="username" value="" type="text" id="test-username" />';
        $this->assertEquals($output, $this->renderer->render($form, 'username'));
    }

}
 