<?php declare(strict_types=1);

namespace MarcOrtola\Cuentica;

use Http\Discovery\Psr18ClientDiscovery;
use MarcOrtola\Cuentica\Api\CustomerApi;
use MarcOrtola\Cuentica\Api\InvoiceApi;
use MarcOrtola\Cuentica\Hydrator\Hydrator;
use MarcOrtola\Cuentica\Hydrator\ModelHydrator;
use Psr\Http\Client\ClientInterface;

final class CuenticaClient
{
    private ClientInterface $httpClient;
    private RequestBuilder $requestBuilder;
    private Hydrator $hydrator;

    public function __construct(
        ClientInterface $httpClient,
        RequestBuilder $requestBuilder,
        ?Hydrator $hydrator = null
    ) {
        $this->httpClient = $httpClient;
        $this->requestBuilder = $requestBuilder;
        $this->hydrator = $hydrator ?? new ModelHydrator();
    }

    public function customer(): CustomerApi
    {
        return new CustomerApi($this->httpClient, $this->requestBuilder, $this->hydrator);
    }

    public function invoice(): InvoiceApi
    {
        return new InvoiceApi($this->httpClient, $this->requestBuilder, $this->hydrator);
    }

    public static function create(
        string $authToken,
        ?ClientInterface $httpClient = null
    ): self {
        return new self(
            $httpClient ?? Psr18ClientDiscovery::find(),
            new RequestBuilder($authToken)
        );
    }
}
