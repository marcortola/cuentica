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

        if (!isset($data['address'], $data['postal_code'], $data['town'], $data['cif'], $data['region'])) {
            throw new HydrationException('Response is not hydratable');
        }

        $customer = new Customer($data['address'], $data['town'], $data['postal_code'], $data['cif'], $data['region']);

        if (isset($data['id'])) {
            $customer->setId($data['id']);
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

    public function dehydrate($object): array
    {
        if (!$object instanceof Customer) {
            throw new HydrationException(
                sprintf('Class should be "%s", "%s" given', Customer::class, \get_class($object))
            );
        }

        $data = [];

        if (null !== $object->getAddress()) {
            $data['address'] = $object->getAddress();
        }

        if (null !== $object->getTown()) {
            $data['town'] = $object->getTown();
        }

        if (null !== $object->getPostalCode()) {
            $data['postal_code'] = $object->getPostalCode();
        }

        if (null !== $object->getCif()) {
            $data['cif'] = $object->getCif();
        }

        if (null !== $object->getTradeName()) {
            $data['tradename'] = $object->getTradeName();
        }

        if (null !== $object->getBusinessName()) {
            $data['business_name'] = $object->getBusinessName();
        }

        if (null !== $object->getName()) {
            $data['name'] = $object->getName();
        }

        if (null !== $object->getFirstSurname()) {
            $data['surname_1'] = $object->getFirstSurname();
        }

        if (null !== $object->getBusinessType()) {
            $data['business_type'] = $object->getBusinessType();
        }

        if (null !== $object->getRegion()) {
            $data['region'] = $object->getRegion();
        }

        if (null !== $object->getLastSurname()) {
            $data['surname_2'] = $object->getLastSurname();
        }

        if (null !== $object->getCountryCode()) {
            $data['country_code'] = $object->getCountryCode();
        }

        if (null !== $object->getDefaultPaymentMethod()) {
            $data['default_payment_method'] = $object->getDefaultPaymentMethod();
        }

        if (null !== $object->getFax()) {
            $data['fax'] = $object->getFax();
        }

        if (null !== $object->getPhone()) {
            $data['phone'] = $object->getPhone();
        }

        if (null !== $object->getWeb()) {
            $data['web'] = $object->getWeb();
        }

        if (null !== $object->getEmail()) {
            $data['email'] = $object->getEmail();
        }

        if (null !== $object->getContactPerson()) {
            $data['contact_person'] = $object->getContactPerson();
        }

        if (null !== $object->getPersonalComment()) {
            $data['personal_comment'] = $object->getPersonalComment();
        }

        if (null !== $object->getDefaultInvoiceLanguage()) {
            $data['default_invoice_language'] = $object->getDefaultInvoiceLanguage();
        }

        if (null !== $object->hasSurcharge()) {
            $data['has_surcharge'] = $object->hasSurcharge();
        }

        return $data;
    }
}
