<?php

namespace MarcOrtola\Cuentica\Model\Customer;

use MarcOrtola\Cuentica\Model\CreatableFromArray;

/**
 * @implements CreatableFromArray<Company|Individual|Customer>
 */
class CustomerFactory implements CreatableFromArray
{
    public static function createFromArray(array $data)
    {
        if (isset($data['business_type'])) {
            switch ($data['business_type']) {
                case 'company':
                    return Company::createFromArray($data);
                case 'individual':
                    return Individual::createFromArray($data);
            }
        }

        return Customer::createFromArray($data);
    }
}
