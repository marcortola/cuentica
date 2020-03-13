<?php

namespace MarcOrtola\Cuentica\Model\Invoice;

use MarcOrtola\Cuentica\Model\Arrayable;
use MarcOrtola\Cuentica\Model\CreatableFromArray;

/**
 * @implements CreatableFromArray<self>
 */
class AmountDetails implements Arrayable, CreatableFromArray
{
    private ?float $totalBase = null;
    private ?float $totalRetention = null;
    private ?float $totalAmount = null;
    private ?float $totalTax = null;
    private ?float $totalCharged = null;
    private ?float $totalLeft = null;
    private ?float $surcharge = null;

    public function getTotalBase(): ?float
    {
        return $this->totalBase;
    }

    public function setTotalBase(float $totalBase): void
    {
        $this->totalBase = $totalBase;
    }

    public function getTotalRetention(): ?float
    {
        return $this->totalRetention;
    }

    public function setTotalRetention(float $totalRetention): void
    {
        $this->totalRetention = $totalRetention;
    }

    public function getTotalAmount(): ?float
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(float $totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }

    public function getTotalTax(): ?float
    {
        return $this->totalTax;
    }

    public function setTotalTax(float $totalTax): void
    {
        $this->totalTax = $totalTax;
    }

    public function getTotalCharged(): ?float
    {
        return $this->totalCharged;
    }

    public function setTotalCharged(float $totalCharged): void
    {
        $this->totalCharged = $totalCharged;
    }

    public function getTotalLeft(): ?float
    {
        return $this->totalLeft;
    }

    public function setTotalLeft(float $totalLeft): void
    {
        $this->totalLeft = $totalLeft;
    }

    public function getSurcharge(): ?float
    {
        return $this->surcharge;
    }

    public function setSurcharge(float $surcharge): void
    {
        $this->surcharge = $surcharge;
    }

    public function toArray(): array
    {
        $data = [];

        if (null !== $this->totalBase) {
            $data['total_base'] = $this->totalBase;
        }

        if (null !== $this->totalRetention) {
            $data['total_retention'] = $this->totalRetention;
        }

        if (null !== $this->totalAmount) {
            $data['total_amount'] = $this->totalAmount;
        }

        if (null !== $this->totalTax) {
            $data['total_tax'] = $this->totalTax;
        }

        if (null !== $this->totalCharged) {
            $data['total_charged'] = $this->totalCharged;
        }

        if (null !== $this->totalLeft) {
            $data['total_left'] = $this->totalLeft;
        }

        if (null !== $this->surcharge) {
            $data['surcharge'] = $this->surcharge;
        }

        return $data;
    }

    public static function createFromArray(array $data): AmountDetails
    {
        $amountDetails = new self();

        $amountDetails->totalBase = $data['total_base'] ?? null;
        $amountDetails->totalRetention = $data['total_retention'] ?? null;
        $amountDetails->totalAmount = $data['total_amount'] ?? null;
        $amountDetails->totalTax = $data['total_tax'] ?? null;
        $amountDetails->totalCharged = $data['total_charged'] ?? null;
        $amountDetails->totalLeft = $data['total_left'] ?? null;
        $amountDetails->surcharge = $data['surcharge'] ?? null;

        return $amountDetails;
    }
}
