<?php declare(strict_types=1);

namespace MarcOrtola\Cuentica\Model;

/**
 * @template T
 */
interface CreatableFromArray
{
    /**
     * @param mixed[] $data
     * @return T
     */
    public static function createFromArray(array $data);
}
