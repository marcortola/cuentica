<?php declare(strict_types=1);

namespace MarcOrtola\Cuentica\Model\Invoice;

use MarcOrtola\Cuentica\Model\Arrayable;
use MarcOrtola\Cuentica\Model\Assert;
use MarcOrtola\Cuentica\Model\CreatableFromArray;

/**
 * @implements CreatableFromArray<self>
 */
class Charge implements Arrayable, CreatableFromArray
{
    private bool $charged;
    private float $amount;
    private string $method;
    private int $destinationAccountId;
    private ?int $id = null;
    private ?string $date = null;
    private ?string $destinationAccountDescription = null;
    private ?string $originAccountNumber = null;
    private ?string $originAccountDescription = null;

    public function __construct(bool $charged, float $amount, string $method, int $destinationAccountId)
    {
        Assert::oneOf($method, ['other', 'cash', 'receipt', 'wire_transfer', 'card', 'promissory_note', 'paypal']);

        $this->charged = $charged;
        $this->amount = $amount;
        $this->method = $method;
        $this->destinationAccountId = $destinationAccountId;
    }

    public function isCharged(): bool
    {
        return $this->charged;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getDestinationAccountId(): int
    {
        return $this->destinationAccountId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): void
    {
        if (null !== $date) {
            Assert::dateString($date);
        }

        $this->date = $date;
    }

    public function getDestinationAccountDescription(): ?string
    {
        return $this->destinationAccountDescription;
    }

    public function setDestinationAccountDescription(string $destinationAccountDescription): void
    {
        $this->destinationAccountDescription = $destinationAccountDescription;
    }

    public function getOriginAccountNumber(): ?string
    {
        return $this->originAccountNumber;
    }

    public function setOriginAccountNumber(string $originAccountNumber): void
    {
        $this->originAccountNumber = $originAccountNumber;
    }

    public function getOriginAccountDescription(): ?string
    {
        return $this->originAccountDescription;
    }

    public function setOriginAccountDescription(string $originAccountDescription): void
    {
        $this->originAccountDescription = $originAccountDescription;
    }

    public function toArray(): array
    {
        $data = [];

        $data['charged'] = $this->charged;
        $data['amount'] = $this->amount;
        $data['method'] = $this->method;
        $data['destination_account'] = $this->destinationAccountId;
        $data['destination_account_id'] = $this->destinationAccountId;

        if (null !== $this->id) {
            $data['id'] = $this->id;
        }

        if (null !== $this->date) {
            $data['date'] = $this->date;
        }

        if (null !== $this->destinationAccountDescription) {
            $data['destination_account_description'] = $this->destinationAccountDescription;
        }

        if (null !== $this->originAccountNumber) {
            $data['origin_account_number'] = $this->originAccountNumber;
        }

        if (null !== $this->originAccountDescription) {
            $data['origin_account_description'] = $this->originAccountDescription;
        }

        return $data;
    }

    public static function createFromArray(array $data): Charge
    {
        if (!isset($data['charged'], $data['amount'], $data['method'], $data['destination_account_id'])) {
            throw new \InvalidArgumentException();
        }

        $charge = new self($data['charged'], $data['amount'], $data['method'], $data['destination_account_id']);

        $charge->id = $data['id'] ?? null;
        $charge->date = $data['date'] ?? null;
        $charge->destinationAccountDescription = $data['destination_account_description'] ?? null;
        $charge->originAccountNumber = $data['origin_account_number'] ?? null;
        $charge->originAccountDescription = $data['origin_account_description'] ?? null;

        return $charge;
    }
}
