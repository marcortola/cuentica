<?php declare(strict_types=1);

namespace MarcOrtola\Cuentica\Model\Customer;

use MarcOrtola\Cuentica\Model\Arrayable;
use MarcOrtola\Cuentica\Model\Assert;
use MarcOrtola\Cuentica\Model\CreatableFromArray;

/**
 * @implements CreatableFromArray<self>
 */
class Customer implements Arrayable, CreatableFromArray
{
    private string $address;
    private string $postalCode;
    private string $town;
    private string $region;
    private string $countryCode;
    private string $cif;
    private ?int $id = null;
    private ?string $defaultPaymentMethod = null;
    protected ?string $businessType = null;
    private ?string $name = null;
    private ?string $firstSurname = null;
    private ?string $lastSurname = null;
    private ?string $contactPerson = null;
    private ?string $phone = null;
    private ?string $email = null;
    private ?string $web = null;
    private ?string $fax = null;
    private ?string $personalComment = null;
    private ?string $defaultInvoiceLanguage = null;
    private ?bool $hasSurcharge = null;

    public function __construct(
        string $address,
        string $town,
        string $postalCode,
        string $cif,
        string $region,
        string $countryCode = 'ES'
    ) {
        Assert::countryCode($countryCode);
        Assert::region($region, $countryCode);

        $this->address = $address;
        $this->town = $town;
        $this->postalCode = $postalCode;
        $this->cif = $cif;
        $this->region = $region;
        $this->countryCode = strtoupper($countryCode);
        $this->businessType = 'others';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
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

    public function getDefaultPaymentMethod(): ?string
    {
        return $this->defaultPaymentMethod;
    }

    public function setDefaultPaymentMethod(?string $defaultPaymentMethod): void
    {
        Assert::oneOf($defaultPaymentMethod, [
            null,
            'cash',
            'receipt',
            'wire_transfer',
            'card',
            'promissory_note',
            'other',
        ]);
        $this->defaultPaymentMethod = $defaultPaymentMethod;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getFirstSurname(): ?string
    {
        return $this->firstSurname;
    }

    public function setFirstSurname(?string $firstSurname): void
    {
        $this->firstSurname = $firstSurname;
    }

    public function getLastSurname(): ?string
    {
        return $this->lastSurname;
    }

    public function setLastSurname(?string $lastSurname): void
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

    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    public function setContactPerson(?string $contactPerson): void
    {
        $this->contactPerson = $contactPerson;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getWeb(): ?string
    {
        return $this->web;
    }

    public function setWeb(?string $web): void
    {
        $this->web = $web;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): void
    {
        $this->fax = $fax;
    }

    public function getPersonalComment(): ?string
    {
        return $this->personalComment;
    }

    public function setPersonalComment(?string $personalComment): void
    {
        $this->personalComment = $personalComment;
    }

    public function getDefaultInvoiceLanguage(): ?string
    {
        return $this->defaultInvoiceLanguage;
    }

    public function setDefaultInvoiceLanguage(?string $defaultInvoiceLanguage): void
    {
        Assert::oneOf($defaultInvoiceLanguage, [null, 'default', 'es', 'eu', 'ca', 'en']);
        $this->defaultInvoiceLanguage = $defaultInvoiceLanguage;
    }

    public function hasSurcharge(): bool
    {
        return true === $this->hasSurcharge;
    }

    public function withSurcharge(): void
    {
        $this->hasSurcharge = true;
    }

    public function withoutSurcharge(): void
    {
        $this->hasSurcharge = false;
    }

    public function toArray(): array
    {
        $data = [];

        $data['address'] = $this->address;
        $data['town'] = $this->town;
        $data['postal_code'] = $this->postalCode;
        $data['cif'] = $this->cif;
        $data['region'] = $this->region;
        $data['country_code'] = $this->countryCode;
        $data['business_type'] = $this->businessType;

        if (null !== $this->id) {
            $data['id'] = $this->id;
        }

        if (null !== $this->name) {
            $data['name'] = $this->name;
        }

        if (null !== $this->firstSurname) {
            $data['surname_1'] = $this->firstSurname;
        }

        if (null !== $this->lastSurname) {
            $data['surname_2'] = $this->lastSurname;
        }

        if (null !== $this->defaultPaymentMethod) {
            $data['default_payment_method'] = $this->defaultPaymentMethod;
        }

        if (null !== $this->fax) {
            $data['fax'] = $this->fax;
        }

        if (null !== $this->phone) {
            $data['phone'] = $this->phone;
        }

        if (null !== $this->web) {
            $data['web'] = $this->web;
        }

        if (null !== $this->email) {
            $data['email'] = $this->email;
        }

        if (null !== $this->contactPerson) {
            $data['contact_person'] = $this->contactPerson;
        }

        if (null !== $this->personalComment) {
            $data['personal_comment'] = $this->personalComment;
        }

        if (null !== $this->defaultInvoiceLanguage) {
            $data['default_invoice_language'] = $this->defaultInvoiceLanguage;
        }

        if (null !== $this->hasSurcharge) {
            $data['has_surcharge'] = $this->hasSurcharge;
        }

        if (null !== $this->defaultInvoiceLanguage) {
            $data['default_invoice_language'] = $this->defaultInvoiceLanguage;
        }

        return $data;
    }

    public static function createFromArray(array $data): Customer
    {
        if (!isset($data['address'], $data['postal_code'], $data['town'], $data['cif'], $data['region'])) {
            throw new \InvalidArgumentException();
        }

        $customer = new self(
            $data['address'],
            $data['town'],
            $data['postal_code'],
            $data['cif'],
            $data['region'],
            $data['country_code'] ?? null
        );

        $customer->id = $data['id'] ?? null;
        $customer->defaultPaymentMethod = $data['default_payment_method'] ?? null;
        $customer->name = $data['name'] ?? null;
        $customer->firstSurname = $data['surname_1'] ?? null;
        $customer->lastSurname = $data['surname_2'] ?? null;
        $customer->contactPerson = $data['contact_person'] ?? null;
        $customer->phone = $data['phone'] ?? null;
        $customer->email = $data['email'] ?? null;
        $customer->web = $data['web'] ?? null;
        $customer->fax = $data['fax'] ?? null;
        $customer->personalComment = $data['personal_comment'] ?? null;
        $customer->hasSurcharge = $data['has_surcharge'] ?? null;
        $customer->defaultInvoiceLanguage = $data['default_invoice_language'] ?? null;

        return $customer;
    }
}
