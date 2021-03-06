<?php
namespace Sirius\Validation\Validator;

class AlphaNumHyphen extends AbstractValidator
{

    protected static $defaultMessageTemplate = 'This input can contain only letters';

    function validate($value, $valueIdentifier = null)
    {
        $this->value = $value;
        $this->success = (bool) ctype_alnum((string) str_replace(array(
            ' ',
            '_',
            '-'
        ), '', $value));
        return $this->success;
    }
}