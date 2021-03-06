<?php
namespace Sirius\Validation\Validator;

class GreaterThan extends AbstractValidator
{

    const OPTION_MIN = 'min';
    const OPTION_INCLUSIVE = 'inclusive';
    
    protected static $defaultMessageTemplate = 'This input must be greater than {min}';

    protected $options = array(
        'inclusive' => true
    );

    function validate($value, $valueIdentifier = null)
    {
        $this->value = $value;
        if (! isset($this->options['min'])) {
            $this->success = true;
        } else {
            if ($this->options['inclusive']) {
                $this->success = $value >= $this->options['min'];
            } else {
                $this->success = $value > $this->options['min'];
            }
        }
        return $this->success;
    }
}