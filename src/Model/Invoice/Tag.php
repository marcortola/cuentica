<?php

namespace MarcOrtola\Cuentica\Model\Invoice;

use MarcOrtola\Cuentica\Model\Arrayable;
use MarcOrtola\Cuentica\Model\CreatableFromArray;

/**
 * @implements CreatableFromArray<self>
 */
class Tag implements Arrayable, CreatableFromArray
{
    private string $name;
    private string $normalizedName;

    public function __construct(string $name, string $normalizedName)
    {
        $this->name = $name;
        $this->normalizedName = $normalizedName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNormalizedName(): string
    {
        return $this->normalizedName;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'normalized_name' => $this->normalizedName,
        ];
    }

    public static function createFromArray(array $data)
    {
        if (!isset($data['name'], $data['normalized_name'])) {
            throw new \InvalidArgumentException();
        }

        return new self($data['name'], $data['normalized_name']);
    }
}
