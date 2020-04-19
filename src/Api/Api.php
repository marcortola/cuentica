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

abstract class Api
{
    protected ClientInterface $httpClient;
    protected RequestBuilder $requestBuilder;
    protected Hydrator $hydrator;

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
     * @param string[] $headers
     * @throws ClientExceptionInterface
     */
    protected function httpGet(string $path, array $parameters = [], array $headers = []): ResponseInterface
    {
        if (\count($parameters) > 0) {
            $path .= '?'.http_build_query($parameters);
        }

        $request = $this->requestBuilder->create('GET', $path, $headers);

        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param mixed[] $parameters
     * @param mixed[] $headers
     * @throws ClientExceptionInterface
     */
    protected function httpPost(string $path, array $parameters = [], array $headers = []): ResponseInterface
    {
        $request = $this->requestBuilder->create(
            'POST',
            $path,
            $headers,
            $this->createJsonBody($parameters)
        );

        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param mixed[] $parameters
     * @param mixed[] $headers
     * @throws ClientExceptionInterface
     */
    protected function httpPut(string $path, array $parameters = [], array $headers = []): ResponseInterface
    {
        $request = $this->requestBuilder->create(
            'PUT',
            $path,
            $headers,
            $this->createJsonBody($parameters)
        );

        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param mixed[] $parameters
     * @param mixed[] $headers
     * @throws ClientExceptionInterface
     */
    protected function httpDelete(string $path, array $parameters = [], array $headers = []): ResponseInterface
    {
        if (\count($parameters) > 0) {
            $path .= '?'.http_build_query($parameters);
        }

        $request = $this->requestBuilder->create('DELETE', $path, $headers);

        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param mixed[] $parameters
     */
    private function createJsonBody(array $parameters): ?string
    {
        if (0 === \count($parameters)) {
            return null;
        }

        try {
            return json_encode($parameters, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            return null;
        }
    }

    /**
     * @return mixed
     * @throws DomainException
     */
    protected function handleResponse(ResponseInterface $response, string $class)
    {
        $this->handleErrors($response);

        return $this->hydrator->hydrate($response, $class);
    }

    /**
     * @throws DomainException
     */
    protected function handleErrors(ResponseInterface $response): void
    {
        if (200 === $response->getStatusCode()) {
            return;
        }

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
