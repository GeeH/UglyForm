<?php

namespace FormTest\Form;


use Respect\Validation\Validator;
use UglyForm\Form\Form;

class FormTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Form
     */
    protected $form;

    public function setUp()
    {
        $this->form = new Form('testForm');
        $this->assertEquals('testForm', $this->form->getName());
    }

    public function testAddElements()
    {
        $element = $this->form->addElement('element1');
        $this->assertCount(1, $this->form->getElements());
        $this->assertInstanceOf('UglyForm\Form\Element', $element);
        $this->assertInstanceOf('UglyForm\Form\Element', $this->form->getElement('element1'));
    }

    public function testElementDoesntExistExcepts()
    {
        $this->setExpectedException('UglyForm\Exception\FormElementException');
        $this->form->getElement('element1');
    }

    public function testAddingSameElementExcepts()
    {
        $this->setExpectedException('UglyForm\Exception\FormElementException');
        $this->form->addElement('element1');
        $this->form->addElement('element1');
    }

    public function testDefaultElementAttributes()
    {
        $this->form->setDefaultElementAttributes(
            array(
                'class' => 'input'
            )
        );
        $this->assertCount(1, $this->form->getDefaultElementAttributes());
    }

    public function testIsValidWhenValid()
    {
        $form = new Form('form');
        $element = $form->addElement('element');
        $element->setValidator(Validator::create()->alwaysValid());

        $otherElement = $form->addElement('other-element');
        $otherElement->setValidator(Validator::create()->alwaysValid());

        $this->assertTrue($form->isValid());
    }

    public function testIsValidWhenInvalid()
    {
        $form = new Form('form');
        $element = $form->addElement('element');
        $element->setValidator(Validator::create()->alwaysValid());

        $otherElement = $form->addElement('other-element');
        $otherElement->setValidator(Validator::create()->alwaysInvalid());

        $this->assertFalse($form->isValid());
    }

    public function testLoadData()
    {
        $this->form->addElement('element');
        $data = array('element' => 'fishcake');
        $this->form->loadData($data);

        $this->assertEquals($data['element'], $this->form->getElement('element')->getValue());
    }

    public function testGetValues()
    {
        $this->form->addElement('element');
        $data = array('element' => 'fishcake');
        $this->form->loadData($data);

        $this->assertEquals($data['element'], $this->form->getValues()['element']);

    }
}
 