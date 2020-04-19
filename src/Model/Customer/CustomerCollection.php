<?php

namespace MarcOrtola\Cuentica\Model\Customer;

use MarcOrtola\Cuentica\Model\Collection;
use MarcOrtola\Cuentica\Model\CreatableFromArray;

/**
 * @implements CreatableFromArray<self>
 * @implements Collection<Customer>
 */
class CustomerCollection implements CreatableFromArray, Collection
{
    /**
     * @var Customer[]
     */
    private array $customers;

    /**
     * @param Customer[] $customers
     */
    private function __construct(array $customers)
    {
        $this->customers = $customers;
    }

    public static function createFromArray(array $data)
    {
        $customers = [];

        foreach ($data as $item) {
            $customers[] = Customer::createFromArray($item);
        }

        return new self($customers);
    }

    public function toArray(): array
    {
        return $this->customers;
    }
}
