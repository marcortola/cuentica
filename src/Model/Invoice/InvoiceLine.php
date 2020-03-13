<?php

namespace MarcOrtola\Cuentica\Model\Invoice;

use MarcOrtola\Cuentica\Model\Arrayable;
use MarcOrtola\Cuentica\Model\Assert;
use MarcOrtola\Cuentica\Model\CreatableFromArray;

/**
 * @implements CreatableFromArray<self>
 */
class InvoiceLine implements Arrayable, CreatableFromArray
{
    private float $quantity;
    private string $concept;
    private float $amount;
    private float $discount;
    private float $tax;
    private float $retention;
    private ?int $id = null;
    private ?float $taxAmount = null;
    private ?float $retentionAmount = null;
    private ?float $surcharge = null;
    private ?float $surchargeAmount = null;

    public function __construct(
        float $quantity,
        string $concept,
        float $amount,
        float $discount,
        float $tax,
        float $retention
    ) {
        Assert::stringNotEmpty($concept);
        Assert::positive($discount);
        Assert::positive($retention);
        Assert::oneOf($tax, [0.0, 3.0, 4.0, 7.0, 9.5, 10.0, 12.0, 13.5, 20.0, 21.0]);

        $this->quantity = $quantity;
        $this->concept = $concept;
        $this->amount = $amount;
        $this->discount = $discount;
        $this->tax = $tax;
        $this->retention = $retention;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function getConcept(): string
    {
        return $this->concept;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function getTax(): float
    {
        return $this->tax;
    }

    public function getRetention(): float
    {
        return $this->retention;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTaxAmount(): ?float
    {
        return $this->taxAmount;
    }

    public function setTaxAmount(float $taxAmount): void
    {
        $this->taxAmount = $taxAmount;
    }

    public function getRetentionAmount(): ?float
    {
        return $this->retentionAmount;
    }

    public function setRetentionAmount(float $retentionAmount): void
    {
        $this->retentionAmount = $retentionAmount;
    }

    public function getSurcharge(): ?float
    {
        return $this->surcharge;
    }

    public function setSurcharge(float $surcharge): void
    {
        $this->surcharge = $surcharge;
    }

    public function getSurchargeAmount(): ?float
    {
        return $this->surchargeAmount;
    }

    public function setSurchargeAmount(float $surchargeAmount): void
    {
        $this->surchargeAmount = $surchargeAmount;
    }

    public function toArray(): array
    {
        $data = [];

        $data['quantity'] = $this->quantity;
        $data['concept'] = $this->concept;
        $data['amount'] = $this->amount;
        $data['discount'] = $this->discount;
        $data['tax'] = $this->tax;
        $data['retention'] = $this->retention;

        if (null !== $this->id) {
            $data['id'] = $this->id;
        }

        if (null !== $this->taxAmount) {
            $data['tax_amount'] = $this->taxAmount;
        }

        if (null !== $this->retentionAmount) {
            $data['retention_amount'] = $this->retentionAmount;
        }

        if (null !== $this->surcharge) {
            $data['surcharge'] = $this->surcharge;
        }

        if (null !== $this->surchargeAmount) {
            $data['surcharge_amount'] = $this->surchargeAmount;
        }

        return $data;
    }

    public static function createFromArray(array $data): InvoiceLine
    {
        if (!isset($data['quantity'], $data['concept'], $data['amount'], $data['discount'], $data['tax'], $data['retention'])) {
            throw new \InvalidArgumentException();
        }

        $line = new self($data['quantity'], $data['concept'], $data['amount'], $data['discount'], $data['tax'], $data['retention']);

        $line->id = $data['id'] ?? null;
        $line->taxAmount = $data['tax_amount'] ?? null;
        $line->retentionAmount = $data['retention_amount'] ?? null;
        $line->surcharge = $data['surcharge'] ?? null;
        $line->surchargeAmount = $data['surcharge_amount'] ?? null;

        return $line;
    }
}
