<?php
namespace Sirius\Validation\Validator;

class NotInList extends InList
{

    protected static $defaultMessageTemplate = 'This input is one of the forbidden values';

    function validate($value, $valueIdentifier = null)
    {
        $this->value = $value;
        if (! isset($this->options['list'])) {
            $this->success = true;
        } else 
            if (is_array($this->options['list'])) {
                $this->success = !in_array($value, $this->options['list']);
            }
        return $this->success;
    }
}