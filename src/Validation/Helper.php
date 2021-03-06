<?php
namespace Sirius\Validation;

use Sirius\Validation\Utils;

class Helper
{

    protected static $methods = array();

    static function addMethod($ruleName, $callback)
    {
        if (is_callable($callback)) {
            self::$methods[$ruleName] = $callback;
            return true;
        }
        return false;
    }

    static function methodExists($name)
    {
        return method_exists(__CLASS__, $name) or array_key_exists($name, self::$methods);
    }

    static function __callStatic($name, $arguments)
    {
        if (array_key_exists($name, self::$methods)) {
            return call_user_func_array(self::$methods[$name], $arguments);
        }
        throw new \InvalidArgumentException(sprintf('Validation method "%s" does not exist', $name));
    }

    static function callback($value, $callback, $context = null)
    {
        $validator = new Validator\Callback();
        $validator->setOption('callback', $callback);
        $validator->setContext($context);
        return $validator->validate($value);
    }

    static function required($value)
    {
        return $value !== null and trim($value) !== '';
    }

    static function truthy($value)
    {
        return $value == true;
    }

    static function falsy($value)
    {
        return $value == false;
    }

    static function number($value)
    {
        return $value == '0' or is_numeric($value);
    }

    static function integer($value)
    {
        return $value == '0' or (int) $value == $value;
    }

    static function lessThan($value, $max)
    {
        $validator = new Validator\LessThan(array(
            'max' => $max
        ));
        return $validator->validate($value);
    }

    static function greaterThan($value, $min)
    {
        $validator = new Validator\GreaterThan(array(
            'min' => $min
        ));
        return $validator->validate($value);
    }

    static function between($value, $min, $max)
    {
        $validator = new Validator\Between(array(
            'min' => $min,
            'max' => $max
        ));
        return $validator->validate($value);
    }

    static function exactly($value, $otherValue)
    {
        return $value == $otherValue;
    }

    static function not($value, $otherValue)
    {
        return ! self::exactly($value, $otherValue);
    }

    static function alpha($value)
    {
        $validator = new Validator\Alpha();
        return $validator->validate($value);
    }

    static function alphanumeric($value)
    {
        $validator = new Validator\AlphaNumeric();
        return $validator->validate($value);
    }

    static function alphanumhyphen($value)
    {
        $validator = new Validator\AlphaNumHyphen();
        return $validator->validate($value);
    }

    static function minLength($value, $min)
    {
        $validator = new Validator\MinLength(array(
            'min' => $min
        ));
        return $validator->validate($value);
    }

    static function maxLength($value, $max)
    {
        $validator = new Validator\MaxLength(array(
            'max' => $max
        ));
        return $validator->validate($value);
    }

    static function length($value, $min, $max)
    {
        $validator = new Validator\Length(array(
            'min' => $min,
            'max' => $max
        ));
        return $validator->validate($value);
    }

    static function setMinSize($value, $min)
    {
        $validator = new Validator\ArrayMinLength(array(
            'min' => $min
        ));
        return $validator->validate($value);
    }

    static function setMaxSize($value, $max)
    {
        $validator = new Validator\ArrayMaxLength(array(
            'max' => $max
        ));
        return $validator->validate($value);
    }

    static function setSize($value, $min, $max)
    {
        $validator = new Validator\ArrayLength(array(
            'min' => $min,
            'max' => $max
        ));
        return $validator->validate($value);
    }

    static function in($value, $values)
    {
        $validator = new Validator\InList(array(
            'list' => $values
        ));
        return $validator->validate($value);
    }

    static function notIn($value, $values)
    {
        $validator = new Validator\NotInList(array(
            'list' => $values
        ));
        return $validator->validate($value);
    }

    static function regex($value, $pattern)
    {
        $validator = new Validator\Regex(array(
            'pattern' => $pattern
        ));
        return $validator->validate($value);
    }

    static function notRegex($value, $pattern)
    {
        $validator = new Validator\NotRegex(array(
            'pattern' => $pattern
        ));
        return $validator->validate($value);
    }

    static function equalTo($value, $otherElement, $context)
    {
        return $value == Utils::arrayGetByPath($context, $otherElement);
    }

    static function date($value, $format = 'Y-m-d')
    {
        $validator = new Validator\Date(array(
        	'format' => $format
        ));
        return $validator->validate($value);
    }

    static function dateTime($value, $format = 'Y-m-d H:i:s')
    {
        $validator = new Validator\DateTime(array(
        	'format' => $format
        ));
        return $validator->validate($value);
    }

    static function time($value, $format = 'H:i:s')
    {
        $validator = new Validator\Time(array(
        	'format' => $format
        ));
        return $validator->validate($value);
    }

    static function website($value)
    {
        $validator = new Validator\Website();
        return $validator->validate($value);
    }

    static function url($value)
    {
        $validator = new Validator\Url();
        return $validator->validate($value);
    }

    /**
     * Test if a variable is a valid IP address
     *
     * @param string $value            
     * @return bool
     */
    static function ip($value)
    {
        $validator = new Validator\IpAddress();
        return $validator->validate($value);
    }

    static function email($value)
    {
        $validator = new Validator\Email();
        return $validator->validate($value);
    }

    /**
     * Test if a variable is a full name
     * Criterias: at least 6 characters, 2 words
     *
     * @param mixed $value            
     * @return bool
     */
    static function fullName($value)
    {
        $validator = new Validator\FullName();
        return $validator->validate($value);
    }

    /**
     * Test if the domain of an email address is available
     *
     * @param string $value            
     * @return bool
     */
    public static function emailDomain($value)
    {
        $validator = new Validator\EmailDomain();
        return $validator->validate($value);
    }
}