<?php
namespace Sirius\Validation\Validator;

class Url extends AbstractValidator
{

    protected static $defaultMessageTemplate = 'This input is not a valid URL';

    function validate($value, $valueIdentifier = null)
    {
        $this->value = $value;
        $this->success = (bool) filter_var($value, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED);
        return $this->success;
    }
}