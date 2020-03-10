<?php

namespace MarcOrtola\Cuentica\Model\Customer;

class Customer
{
    private int $id;
    private string $cif;
    private string $tradeName;
    private string $defaultPaymentMethod;
    private string $businessType;
    private string $businessName;
    private string $name;
    private string $firstSurname;
    private string $lastSurname;
    private string $address;
    private string $postalCode;
    private string $town;
    private string $region;
    private string $countryCode;
    private string $contactPerson;
    private string $phone;
    private string $email;
    private string $web;
    private string $fax;
    private string $personalComment;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCif(): string
    {
        return $this->cif;
    }

    public function setCif(string $cif): void
    {
        $this->cif = $cif;
    }

    public function getTradeName(): string
    {
        return $this->tradeName;
    }

    public function setTradeName(string $tradeName): void
    {
        $this->tradeName = $tradeName;
    }

    public function getDefaultPaymentMethod(): string
    {
        return $this->defaultPaymentMethod;
    }

    public function setDefaultPaymentMethod(string $defaultPaymentMethod): void
    {
        $this->defaultPaymentMethod = $defaultPaymentMethod;
    }

    public function getBusinessType(): string
    {
        return $this->businessType;
    }

    public function setBusinessType(string $businessType): void
    {
        $this->businessType = $businessType;
    }

    public function getBusinessName(): string
    {
        return $this->businessName;
    }

    public function setBusinessName(string $businessName): void
    {
        $this->businessName = $businessName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getFirstSurname(): string
    {
        return $this->firstSurname;
    }

    public function setFirstSurname(string $firstSurname): void
    {
        $this->firstSurname = $firstSurname;
    }

    public function getLastSurname(): string
    {
        return $this->lastSurname;
    }

    public function setLastSurname(string $lastSurname): void
    {
        $this->lastSurname = $lastSurname;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getTown(): string
    {
        return $this->town;
    }

    public function setTown(string $town): void
    {
        $this->town = $town;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function getContactPerson(): string
    {
        return $this->contactPerson;
    }

    public function setContactPerson(string $contactPerson): void
    {
        $this->contactPerson = $contactPerson;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getWeb(): string
    {
        return $this->web;
    }

    public function setWeb(string $web): void
    {
        $this->web = $web;
    }

    public function getFax(): string
    {
        return $this->fax;
    }

    public function setFax(string $fax): void
    {
        $this->fax = $fax;
    }

    public function getPersonalComment(): string
    {
        return $this->personalComment;
    }

    public function setPersonalComment(string $personalComment): void
    {
        $this->personalComment = $personalComment;
    }
}
