<?php
namespace Sirius\Validation\Validator;

class MaxLength extends AbstractValidator
{

    const OPTION_MAX = 'max';

    protected static $defaultMessageTemplate = 'This input have less than {max} characters';

    protected $options = array();

    function validate($value, $valueIdentifier = null)
    {
        $this->value = $value;
        if (! isset($this->options['max'])) {
            $this->success = true;
        } else {
            $this->success = strlen($value) <= $this->options['max'];
        }
        return $this->success;
    }
}