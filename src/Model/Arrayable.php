<?php declare(strict_types=1);

namespace MarcOrtola\Cuentica\Model;

interface Arrayable
{
    /**
     * @return mixed[]
     */
    public function toArray(): array;
}
