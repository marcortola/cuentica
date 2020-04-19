<?php declare(strict_types=1);

namespace MarcOrtola\Cuentica\Api;

use MarcOrtola\Cuentica\Exception\Domain\DomainException;
use MarcOrtola\Cuentica\Model\Invoice\Invoice;
use MarcOrtola\Cuentica\Model\Invoice\InvoiceFactory;
use Psr\Http\Client\ClientExceptionInterface;

class InvoiceApi extends Api
{
    /**
     * @see https://apidocs.cuentica.com/versions/latest_release/#customer-id
     * @throws DomainException
     * @throws ClientExceptionInterface
     */
    public function invoice(int $id): Invoice
    {
        $response = $this->httpGet('/invoice/'.$id);

        return $this->handleResponse($response, InvoiceFactory::class);
    }

    /**
     * @see https://apidocs.cuentica.com/versions/latest_release/#customer-id
     * @throws DomainException
     * @throws ClientExceptionInterface
     */
    public function pdf(int $id): string
    {
        $response = $this->httpGet('/invoice/'.$id.'/pdf');

        return $this->handleResponse($response);
    }

    /**
     * @see https://apidocs.cuentica.com/versions/latest_release/#customer
     * @throws DomainException
     * @throws ClientExceptionInterface
     */
    public function create(Invoice $invoice): Invoice
    {
        $response = $this->httpPost('/invoice', $invoice->toArray());

        return $this->handleResponse($response, InvoiceFactory::class);
    }
}
