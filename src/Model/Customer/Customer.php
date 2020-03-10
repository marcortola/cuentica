<?php

namespace MarcOrtola\Cuentica\Model\Customer;

class Customer
{
    private ?int $id = null;
    private ?string $cif = null;
    private ?string $tradeName = null;
    private ?string $defaultPaymentMethod = null;
    private ?string $businessType = null;
    private ?string $businessName = null;
    private ?string $name = null;
    private ?string $firstSurname = null;
    private ?string $lastSurname = null;
    private ?string $address = null;
    private ?string $postalCode = null;
    private ?string $town = null;
    private ?string $region = null;
    private ?string $countryCode = null;
    private ?string $contactPerson = null;
    private ?string $phone = null;
    private ?string $email = null;
    private ?string $web = null;
    private ?string $fax = null;
    private ?string $personalComment = null;
    private ?string $defaultInvoiceLanguage = null;
    private ?bool $hasSurcharge = null;

    public function __construct(string $address, string $town, string $postalCode, string $cif, string $region)
    {
        $this->address = $address;
        $this->town = $town;
        $this->postalCode = $postalCode;
        $this->cif = $cif;
        $this->region = $region;
        $this->businessType = 'others';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCif(): ?string
    {
        return $this->cif;
    }

    public function setCif(string $cif): void
    {
        $this->cif = $cif;
    }

    public function getTradeName(): ?string
    {
        return $this->tradeName;
    }

    public function setTradeName(string $tradeName): void
    {
        $this->tradeName = $tradeName;
    }

    public function getDefaultPaymentMethod(): ?string
    {
        return $this->defaultPaymentMethod;
    }

    public function setDefaultPaymentMethod(string $defaultPaymentMethod): void
    {
        $this->defaultPaymentMethod = $defaultPaymentMethod;
    }

    public function getBusinessType(): ?string
    {
        return $this->businessType;
    }

    public function setBusinessType(string $businessType): void
    {
        $this->businessType = $businessType;
    }

    public function getBusinessName(): ?string
    {
        return $this->businessName;
    }

    public function setBusinessName(string $businessName): void
    {
        $this->businessName = $businessName;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getFirstSurname(): ?string
    {
        return $this->firstSurname;
    }

    public function setFirstSurname(string $firstSurname): void
    {
        $this->firstSurname = $firstSurname;
    }

    public function getLastSurname(): ?string
    {
        return $this->lastSurname;
    }

    public function setLastSurname(string $lastSurname): void
    {
        $this->lastSurname = $lastSurname;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): void
    {
        $this->town = $town;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    public function setContactPerson(string $contactPerson): void
    {
        $this->contactPerson = $contactPerson;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getWeb(): ?string
    {
        return $this->web;
    }

    public function setWeb(string $web): void
    {
        $this->web = $web;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax): void
    {
        $this->fax = $fax;
    }

    public function getPersonalComment(): ?string
    {
        return $this->personalComment;
    }

    public function setPersonalComment(string $personalComment): void
    {
        $this->personalComment = $personalComment;
    }

    public function getDefaultInvoiceLanguage(): ?string
    {
        return $this->defaultInvoiceLanguage;
    }

    public function setDefaultInvoiceLanguage(?string $defaultInvoiceLanguage): void
    {
        $this->defaultInvoiceLanguage = $defaultInvoiceLanguage;
    }

    public function hasSurcharge(): ?bool
    {
        return $this->hasSurcharge;
    }

    public function withSurcharge(?bool $surcharge): void
    {
        $this->hasSurcharge = $surcharge;
    }
}
