<?php

namespace MarcOrtola\Cuentica;

use Http\Discovery\Psr18ClientDiscovery;
use MarcOrtola\Cuentica\Api\Customer;
use Psr\Http\Client\ClientInterface;

final class CuenticaClient
{
    private ClientInterface $httpClient;
    private RequestBuilder $requestBuilder;

    private function __construct(ClientInterface $httpClient, RequestBuilder $requestBuilder)
    {
        $this->httpClient = $httpClient;
        $this->requestBuilder = $requestBuilder;
    }

    public function customer(): Customer
    {
        return new Customer($this->httpClient, $this->requestBuilder);
    }

    public static function create(string $authToken): self
    {
        return new self(
            Psr18ClientDiscovery::find(),
            new RequestBuilder($authToken)
        );
    }
}
