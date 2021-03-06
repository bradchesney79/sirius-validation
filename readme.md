#Sirius Validation

[![Build Status](https://travis-ci.org/adrianmiu/sirius-validation.png?branch=master)](https://travis-ci.org/adrianmiu/sirius-validation)
[![Coverage Status](https://coveralls.io/repos/adrianmiu/sirius-validation/badge.png)](https://coveralls.io/r/adrianmiu/sirius-validation)

Sirius Validation is a library for data validation. It offers:

1. a [validator object](docs/validator.md) to validate arrays, `ArrayObjects` or objects that have a `toArray` method. Of course you can extend it to validate your own type of objects.
2. a [validation helper](docs/helper.md) to validate single values 
3. a set of [build-in value validators](docs/validators.md) to perform the actual data validation. The value validators are used by the helper and validation objects.

##Elevator pitch

```php
$validator = new \Sirius\Validation\Validator;

// add a validation rule
$validator->add('title', 'required');

// add a rule that has a list of options
$validator->add('title', 'maxlength', array('max' => 100);
// or use JSON
$validator->add('title', 'maxlength', '{"max": 100}');
// or a URL query string
$validator->add('title', 'maxlength', 'max=100');

// add a rule with a custom error message
$validator->add('title', 'maxlength', 'max=100', 'Article title must have less than {max} characters');

// add a rule with a custom message and a label (very handy with forms)
$validator->add('title', 'maxlength', 'max=100', '{label} must have less than {max} characters', 'Title');

// add all of rule's configuration in a string (you'll see later why it's handy')
$validator->add('title', 'maxlength(max=10)({label} must have less than {max} characters)(Title)');

// add multiple rules at once (separate using [space][pipe][space])
$validator->add('title', 'required | maxlength(max=10)({label} must have less than {max} characters)(Title)');

// add all your rules at once
$validator->add(array(
	'title' => 'required | maxlength(max=10)({label} must have less than {max} characters)(Title)',
	'content' => 'required',
	'source' => 'website'
));

// add nested rules
$validator->add('recipients[*]', 'email'); //all recipients must be valid email addresses
$validator->add('shipping_address[city]', 'MyApp\Validator\City'); // uses a custom validator to validate the shipping city

```

##Goal

I started this library having in mind a form representing an invoice, which seems one of the most difficult forms to validate
- it has a date which can be localized
- it has a billing address section that contains various fields, each with its own validation rules
- it has a shipping address section whos fields must be provided and validated only if the "same as billing address" checkbox is unchecked
- it has at least on line (of product/service) with name, quantity and price
- it has a payment method
- it has payment details which must be validated against the rules required by the payment method
- it can have a list of recipients that will get the invoice by email if the user chooses to fill them out.

The same example may be applied if data is received through, for example, a REST service.

##Why (just) arrays?

1. Arrays are the most common data containers. 
2. Forms are populated via arrays and send data to the server via arrays
3. Arrays can be converted from/into JSONs making it easy to move data from server-side to client-side
4. Domain models can be converted into arrays and validate that array copy

So, while the original goals was to make it easy to validate forms it was easy to make it work with objects. 
Out-of-the-box, the library can handle `ArrayObject`s and objects that have the `toArray` method. The `Validator` class can be easily extended to handle different data containers.


[go to the documentation](docs/index.md)
