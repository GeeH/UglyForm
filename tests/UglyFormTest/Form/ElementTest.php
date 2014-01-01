<?php
/**
 * User: garyhockin
 * Date: 30/12/2013
 * Time: 09:12
 */

namespace FormTest\Form;


use Respect\Validation\Validator;
use UglyForm\Filter\StripWhitespace;
use UglyForm\Form\Element;

class ElementTest extends \PHPUnit_Framework_TestCase
{
    /** @var Element */
    protected $element;

    public function setUp()
    {
        $this->element = new Element('test');
    }


    function testConstruct()
    {
        $this->assertEquals('test', $this->element->getName());
        $this->assertEquals('input', $this->element->getTag());
    }

    public function testFilters()
    {
        $this->element->setFilters(array(
            'foo',
            'bar',
        ));
        $this->assertCount(2, $this->element->getFilters());

        $this->element->addFilter('train');
        $this->assertCount(3, $this->element->getFilters());
    }

    public function testTag()
    {
        $this->element->setTag('button');
        $this->assertEquals('button', $this->element->getTag());
    }

    public function testValidator()
    {
        $this->element->setValidator(Validator::create()->string());
        $this->assertInstanceOf('Respect\Validation\Validator', $this->element->getValidator());
    }

    public function testValue()
    {
        $this->element->setValue('value');
        $this->assertEquals('value', $this->element->getValue());
    }

    public function testNoValidationReturnsTrue()
    {
        $this->assertTrue($this->element->isValid());
    }

    public function testValidationRuns()
    {
        // validation runs the validator
        $this->element->setValidator(Validator::create()->string()->notEmpty());
        $this->assertFalse($this->element->isValid());
    }

    public function testBumValidatorExcepts()
    {
        $this->setExpectedException('UglyForm\Exception\FormElementException');
        $this->element->setValidator(new \stdClass());
        $this->element->isValid();
    }

    public function testFilteringWithoutFilters()
    {
        $this->assertFalse($this->element->filter());
    }

    public function testFilteringWithFilters()
    {
        $this->element->addFilter(new StripWhitespace());
        $this->element->setValue('   whitespace   ');
        $this->assertTrue($this->element->filter());
        $this->assertEquals('whitespace', $this->element->getValue());
        // filtering again should return false
        $this->assertFalse($this->element->filter());
    }

    public function testAttributes()
    {
        $this->element->setattributes(array('foo' => 'bar', 'class' => 'input'));
        $this->assertCount(2, $this->element->getattributes());
    }

    public function testLabel()
    {
        $this->element->setLabel('Dogs > Cats');
        $this->assertEquals('Dogs > Cats', $this->element->getLabel());
    }
}
 