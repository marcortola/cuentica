<?php

namespace MarcOrtola\Cuentica\Api;

use MarcOrtola\Cuentica\Exception\Domain\DomainException;
use MarcOrtola\Cuentica\Model\Customer\Customer;
use MarcOrtola\Cuentica\Model\Customer\CustomerFactory;
use Psr\Http\Client\ClientExceptionInterface;

class CustomerApi extends Api
{
    /**
     * @see https://apidocs.cuentica.com/versions/latest_release/#customer-id
     * @throws DomainException
     * @throws ClientExceptionInterface
     */
    public function customer(int $id): Customer
    {
        $response = $this->httpGet('/customer/'.$id);

        return $this->handleResponse($response, CustomerFactory::class);
    }

    /**
     * @see https://apidocs.cuentica.com/versions/latest_release/#customer
     * @throws DomainException
     * @throws ClientExceptionInterface
     */
    public function create(Customer $customer): Customer
    {
        $response = $this->httpPost('/customer', $customer->toArray());

        return $this->handleResponse($response, CustomerFactory::class);
    }

    /**
     * @see https://apidocs.cuentica.com/versions/latest_release/#customer-id
     * @throws DomainException
     * @throws ClientExceptionInterface
     */
    public function update(Customer $customer): Customer
    {
        $response = $this->httpPut('/customer/'.$customer->getId(), $customer->toArray());

        return $this->handleResponse($response, CustomerFactory::class);
    }
}
