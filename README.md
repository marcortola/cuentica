# Community API client for Cuéntica online management software

[![Latest Version](https://img.shields.io/github/release/marcortola/cuentica.svg?style=flat-square)](https://github.com/marcortola/cuentica/releases)
[![Build Status](https://img.shields.io/travis/marcortola/cuentica.svg?style=flat-square)](https://travis-ci.org/marcortola/cuentica)
[![Total Downloads](https://img.shields.io/packagist/dt/marcortola/cuentica.svg?style=flat-square)](https://packagist.org/packages/marcortola/cuentica)

Installation
------------

1. [Install Composer](https://getcomposer.org/download/)
2. Execute:

```
$ composer require marcortola/cuentica
```

Usage
------------
```php
use MarcOrtola\Cuentica\CuenticaClient;

$cuenticaClient = CuenticaClient::create('your_auth_token');

// Find a customer by ID.
$customer = $cuenticaClient->customer()->customer(1);

// Update a customer by ID.
$customer = $cuenticaClient->customer()->customer(1);
$customer->setCountryCode('US');
$cuenticaClient->customer()->update($customer);

// Create a customer (it's individual, but can be a company or a generic one).
$customer = new Individual(
    'My street',
    'My City',
    '40100',
    '44444444I',
    'My region',
    'My name',
    'My surname'
);
$cuenticaClient->customer()->create($customer);

// Create an invoice.
$invoice = new Invoice(
    true,
    [new InvoiceLine(1, 'Concept', 100, 2, 10, 4)],
    [new Charge(false, 103.88, 'other', 42133)]
);
$cuenticaClient->invoice()->create($invoice);
```
Read the Cuéntica API documentation [here](https://apidocs.cuentica.com/versions/latest_release/).

License
------------

Licensed under the MIT License. See [License File](LICENSE) for more information about it.
