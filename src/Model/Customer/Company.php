<?php

namespace MarcOrtola\Cuentica\Model\Customer;

class Company extends Customer
{
    private string $businessName;
    private string $tradeName;

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

        $this->businessType = 'company';
        $this->businessName = $businessName;
        $this->tradeName = $tradeName;
    }

    public function getBusinessName(): string
    {
        return $this->businessName;
    }

    public function getTradeName(): string
    {
        return $this->tradeName;
    }

    public static function createFromArray(array $data): Company
    {
        if (!isset($data['business_name'], $data['tradename'])) {
            throw new \InvalidArgumentException();
        }

        $customer = parent::createFromArray($data);

        $company = new self(
            $customer->getAddress(),
            $customer->getTown(),
            $customer->getPostalCode(),
            $customer->getCif(),
            $customer->getRegion(),
            $data['business_name'],
            $data['tradename']
        );

        $company->setId($customer->getId());
        $company->setDefaultPaymentMethod($customer->getDefaultPaymentMethod());
        $company->setName($customer->getName());
        $company->setFirstSurname($customer->getFirstSurname());
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

    public function toArray(): array
    {
        $data = parent::toArray();

        $data['tradename'] = $this->tradeName;
        $data['business_name'] = $this->businessName;

        return $data;
    }
}
