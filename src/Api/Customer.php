<?php

namespace MarcOrtola\Cuentica\Api;

use MarcOrtola\Cuentica\Hydrator\CustomerHydrator;
use MarcOrtola\Cuentica\Model\Customer\Customer as Model;
use MarcOrtola\Cuentica\RequestBuilder;
use Psr\Http\Client\ClientInterface;

/**
 * @extends Api<Model>
 */
class Customer extends Api
{
    public function __construct(ClientInterface $httpClient, RequestBuilder $requestBuilder)
    {
        parent::__construct($httpClient, $requestBuilder, new CustomerHydrator());
    }

    public function customer(int $id): Model
    {
        $response = $this->httpGet('/customer/'.$id);

        return $this->handleResponse($response, Model::class);
    }
}
