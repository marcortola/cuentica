<?php

namespace MarcOrtola\Cuentica\Model\Customer;

class Individual extends Customer
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

        $this->businessType = 'individual';
        $this->setName($name);
        $this->setFirstSurname($firstSurname);
    }

    public static function createFromArray(array $data): Individual
    {
        if (!isset($data['name'], $data['surname_1'])) {
            throw new \InvalidArgumentException();
        }

        $customer = parent::createFromArray($data);

        $company = new self(
            $customer->getAddress(),
            $customer->getTown(),
            $customer->getPostalCode(),
            $customer->getCif(),
            $customer->getRegion(),
            $data['name'],
            $data['surname_1']
        );

        $company->setId($customer->getId());
        $company->setDefaultPaymentMethod($customer->getDefaultPaymentMethod());
        $company->setLastSurname($customer->getLastSurname());
        $company->setContactPerson($customer->getContactPerson());
        $company->setPhone($customer->getPhone());
        $company->setEmail($customer->getEmail());
        $company->setWeb($customer->getWeb());
        $company->setFax($customer->getFax());
        $company->setPersonalComment($customer->getPersonalComment());
        $company->setDefaultInvoiceLanguage($customer->getDefaultInvoiceLanguage());
        $company->withoutSurcharge();
        if ($company->hasSurcharge()) {
            $company->withSurcharge();
        }

        return $company;
    }
}
