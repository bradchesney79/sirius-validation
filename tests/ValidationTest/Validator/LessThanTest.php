<?php

namespace Sirius\Validation\Validator\Test;

use Sirius\Validation\Validator\LessThan as Validator;

class LessThanTest extends \PHPUnit_Framework_TestCase  {
    
    function setUp() {
        $this->validator = new Validator();
    }
    
    function testExclusiveValidation() {
        $this->validator->setOption('inclusive', false);
        $this->validator->setOption('max', 100);
        $this->assertFalse($this->validator->validate(100));
    }
    
    function testValidationWithoutALimit() {
        $this->assertTrue($this->validator->validate(0));
    }
}