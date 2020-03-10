<?php

namespace MarcOrtola\Cuentica\Api;

use MarcOrtola\Cuentica\Exception\Domain\BadRequestException;
use MarcOrtola\Cuentica\Exception\Domain\DomainException;
use MarcOrtola\Cuentica\Exception\Domain\NotFoundException;
use MarcOrtola\Cuentica\Exception\Domain\TooManyRequestsException;
use MarcOrtola\Cuentica\Exception\Domain\UnauthorizedException;
use MarcOrtola\Cuentica\Exception\Domain\UnknownException;
use MarcOrtola\Cuentica\Hydrator\Hydrator;
use MarcOrtola\Cuentica\RequestBuilder;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @template T
 */
abstract class Api
{
    protected ClientInterface $httpClient;
    protected RequestBuilder $requestBuilder;
    /**
     * @var Hydrator<T>
     */
    protected Hydrator $hydrator;

    /**
     * @param Hydrator<T> $hydrator
     */
    public function __construct(
        ClientInterface $httpClient,
        RequestBuilder $requestBuilder,
        Hydrator $hydrator
    ) {
        $this->httpClient = $httpClient;
        $this->requestBuilder = $requestBuilder;
        $this->hydrator = $hydrator;
    }

    /**
     * @param string[] $parameters
     * @throws ClientExceptionInterface
     */
    protected function httpGet(string $path, array $parameters = []): ResponseInterface
    {
        if (\count($parameters) > 0) {
            $path .= '?'.http_build_query($parameters);
        }

        $request = $this->requestBuilder->create('GET', $path);

        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param class-string<T> $class
     * @return T
     * @throws DomainException
     */
    protected function handleResponse(ResponseInterface $response, string $class)
    {
        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, $class);
    }

    /**
     * @throws DomainException
     */
    protected function handleErrors(ResponseInterface $response): void
    {
        $message = $response->getBody()->__toString();

        switch ($response->getStatusCode()) {
            case 400:
                throw new BadRequestException($message);
            case 403:
                throw new UnauthorizedException($message);
            case 404:
                throw new NotFoundException($message);
            case 429:
                throw new TooManyRequestsException($message);
            default:
                throw new UnknownException($message);
        }
    }
}
