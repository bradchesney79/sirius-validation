<?php
namespace Sirius\Validation\Validator;

class LessThan extends AbstractValidator
{

    const OPTION_MAX = 'max';
    const OPTION_INCLUSIVE = 'inclusive';
    
    protected static $defaultMessageTemplate = 'This input must be less than {max}';

    protected $options = array(
        'inclusive' => true
    );

    function validate($value, $valueIdentifier = null)
    {
        $this->value = $value;
        if (! isset($this->options['max'])) {
            $this->success = true;
        } else {
            if ($this->options['inclusive']) {
                $this->success = $value <= $this->options['max'];
            } else {
                $this->success = $value < $this->options['max'];
            }
        }
        return $this->success;
    }
}