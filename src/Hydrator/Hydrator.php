<?php

namespace MarcOrtola\Cuentica\Hydrator;

use Psr\Http\Message\ResponseInterface;

/**
 * @template T
 */
interface Hydrator
{
    /**
     * @param class-string<T> $class
     * @return T
     */
    public function hydrate(ResponseInterface $response, string $class);

    /**
     * @param T $object
     * @return mixed[]
     */
    public function dehydrate($object): array;
}
