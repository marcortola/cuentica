<?php

namespace MarcOrtola\Cuentica\Model\Customer;

class IndividualCustomer extends Customer
{
    public function __construct(
        string $address,
        string $town,
        string $postalCode,
        string $cif,
        string $region,
        string $name,
        string $firstSurname
    ) {
        parent::__construct($address, $town, $postalCode, $cif, $region);

        $this->setName($name);
        $this->setFirstSurname($firstSurname);
        $this->setBusinessType('individual');
    }
}
