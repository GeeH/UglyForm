<?php

namespace FormTest\Form;


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

}
 