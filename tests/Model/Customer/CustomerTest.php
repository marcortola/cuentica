<?php

declare(strict_types=1);

namespace MarcOrtola\Cuentica\Tests\Model\Customer;

use MarcOrtola\Cuentica\Model\Customer\Company;
use MarcOrtola\Cuentica\Model\Customer\CustomerFactory;
use MarcOrtola\Cuentica\Model\Customer\Individual;
use PHPStan\Testing\TestCase;

final class CustomerTest extends TestCase
{
    /** @test */
    public function validApiArrayCustomerResponseShouldBeValidIndividualCustomer(): void
    {
        $input = [
            'address' => 'Street 1',
            'town' => 'Madrid',
            'postal_code' => '9100',
            'cif' => '',
            'region' => 'Texas',
            'country_code' => 'AR',
            'business_type' => 'individual',
            'id' => 597119,
            'name' => 'Steve',
            'surname_1' => 'Gates',
            'email' => 'invent@email.com',
            'personal_comment' => 'This is a comment.',
        ];

        $customer = new Individual('Street 1', 'Madrid', '9100', '', 'Texas', 'AR', 'Steve', 'Gates');
        $customer->setId(597119);
        $customer->setEmail('invent@email.com');
        $customer->setPersonalComment('This is a comment.');

        $this->assertEquals($customer, CustomerFactory::createFromArray($input));
    }

    /** @test */
    public function validApiArrayCustomerResponseShouldBeValidCompanyCustomer(): void
    {
        $input = [
            'address' => 'Street 1',
            'town' => 'Madrid',
            'postal_code' => '9100',
            'cif' => '',
            'region' => 'Texas',
            'country_code' => 'AR',
            'business_type' => 'company',
            'business_name' => 'My business name',
            'tradename' => 'That tradename',
            'id' => 597119,
            'name' => 'Steve',
            'surname_1' => 'Gates',
            'email' => 'invent@email.com',
            'personal_comment' => 'This is a comment.',
        ];

        $customer = new Company('Street 1', 'Madrid', '9100', '', 'Texas', 'AR', 'My business name', 'That tradename');
        $customer->setId(597119);
        $customer->setName('Steve');
        $customer->setFirstSurname('Gates');
        $customer->setEmail('invent@email.com');
        $customer->setPersonalComment('This is a comment.');

        $this->assertEquals($customer, CustomerFactory::createFromArray($input));
    }
}
