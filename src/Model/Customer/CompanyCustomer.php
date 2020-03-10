<?php

namespace MarcOrtola\Cuentica\Model\Customer;

class CompanyCustomer extends Customer
{
    public function __construct(
        string $address,
        string $town,
        string $postalCode,
        string $cif,
        string $region,
        string $businessName,
        string $tradeName
    ) {
        parent::__construct($address, $town, $postalCode, $cif, $region);

        $this->setBusinessType('company');
        $this->setBusinessName($businessName);
        $this->setTradeName($tradeName);
    }
}
