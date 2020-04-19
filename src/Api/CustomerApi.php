<?php declare(strict_types=1);

namespace MarcOrtola\Cuentica\Api;

use MarcOrtola\Cuentica\Exception\Domain\DomainException;
use MarcOrtola\Cuentica\Model\Customer\Customer;
use MarcOrtola\Cuentica\Model\Customer\CustomerCollection;
use MarcOrtola\Cuentica\Model\Customer\CustomerFactory;
use Psr\Http\Client\ClientExceptionInterface;

class CustomerApi extends Api
{
    /**
     * @see https://apidocs.cuentica.com/versions/latest_release/?php#customer
     * @throws DomainException
     * @throws ClientExceptionInterface
     *
     * @return Customer[]
     */
    public function search(string $query, ?int $pageSize = null, ?int $page = null): array
    {
        $param = [
            'page_size' => $pageSize ?? 100,
            'page' => $page ?? 1,
            'q' => $query,
        ];

        $response = $this->httpGet('/customer', $param);

        return $this->handleResponse($response, CustomerCollection::class);
    }

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

    /**
     * @see https://apidocs.cuentica.com/versions/latest_release/#customer-id
     * @throws DomainException
     * @throws ClientExceptionInterface
     */
    public function delete(int $id): void
    {
        $response = $this->httpDelete('/customer/'.$id);

        $this->handleErrors($response);
    }
}
