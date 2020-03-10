<?php

namespace MarcOrtola\Cuentica\Hydrator;

use MarcOrtola\Cuentica\Exception\HydrationException;
use MarcOrtola\Cuentica\Model\Customer\Customer;
use Psr\Http\Message\ResponseInterface;

/**
 * @implements Hydrator<Customer>
 */
class CustomerHydrator implements Hydrator
{
    public function hydrate(ResponseInterface $response, string $class): Customer
    {
        $body = $response->getBody()->__toString();

        try {
            $data = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new HydrationException('Response is not hydratable', 0, $e);
        }

        if (Customer::class !== $class) {
            throw new HydrationException(
                sprintf('Class should be "%s", "%s" given', Customer::class, $class)
            );
        }

        $customer = new Customer();

        if (isset($data['id'])) {
            $customer->setId($data['id']);
        }

        if (isset($data['cif'])) {
            $customer->setCif($data['cif']);
        }

        if (isset($data['tradename'])) {
            $customer->setTradeName($data['tradename']);
        }

        if (isset($data['default_payment_method'])) {
            $customer->setDefaultPaymentMethod($data['default_payment_method']);
        }

        if (isset($data['business_type'])) {
            $customer->setBusinessType($data['business_type']);
        }

        if (isset($data['business_name'])) {
            $customer->setBusinessName($data['business_name']);
        }

        if (isset($data['name'])) {
            $customer->setName($data['name']);
        }

        if (isset($data['surname_1'])) {
            $customer->setFirstSurname($data['surname_1']);
        }

        if (isset($data['surname_2'])) {
            $customer->setLastSurname($data['surname_2']);
        }

        if (isset($data['address'])) {
            $customer->setAddress($data['address']);
        }

        if (isset($data['postal_code'])) {
            $customer->setPostalCode($data['postal_code']);
        }

        if (isset($data['town'])) {
            $customer->setTown($data['town']);
        }

        if (isset($data['region'])) {
            $customer->setRegion($data['region']);
        }

        if (isset($data['country_code'])) {
            $customer->setCountryCode($data['country_code']);
        }

        if (isset($data['contact_person'])) {
            $customer->setContactPerson($data['contact_person']);
        }

        if (isset($data['phone'])) {
            $customer->setPhone($data['phone']);
        }

        if (isset($data['email'])) {
            $customer->setEmail($data['email']);
        }

        if (isset($data['web'])) {
            $customer->setWeb($data['web']);
        }

        if (isset($data['fax'])) {
            $customer->setFax($data['fax']);
        }

        if (isset($data['personal_comment'])) {
            $customer->setPersonalComment($data['personal_comment']);
        }

        return $customer;
    }
}
