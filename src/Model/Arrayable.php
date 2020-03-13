<?php

namespace MarcOrtola\Cuentica\Model;

interface Arrayable
{
    /**
     * @return mixed[]
     */
    public function toArray(): array;
}
