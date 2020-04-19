<?php declare(strict_types=1);

namespace MarcOrtola\Cuentica;

use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

final class RequestBuilder
{
    private string $baseUri = 'https://api.cuentica.com';
    private RequestFactoryInterface $requestFactory;
    private StreamFactoryInterface $streamFactory;
    private string $authToken;

    public function __construct(
        string $authToken,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null
    ) {
        $this->authToken = $authToken;
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();
    }

    /**
     * @param string[] $headers
     */
    public function create(
        string $method,
        string $path,
        array $headers = [],
        ?string $body = null
    ): RequestInterface {
        $request = $this->requestFactory->createRequest($method, $this->baseUri.$path);
        $request = $request->withHeader('X-AUTH-TOKEN', $this->authToken);

        foreach ($headers as $header => $value) {
            $request = $request->withHeader($header, $value);
        }

        if (null !== $body) {
            $request = $request->withHeader('Content-type', 'application/json');
            $request = $request->withBody($this->streamFactory->createStream($body));
        }

        return $request;
    }
}
