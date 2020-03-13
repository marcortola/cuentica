<?php

namespace MarcOrtola\Cuentica\Model\Invoice;

use MarcOrtola\Cuentica\Model\CreatableFromArray;

/**
 * @implements CreatableFromArray<Invoice|RecurrentInvoice>
 */
class InvoiceFactory implements CreatableFromArray
{
    public static function createFromArray(array $data)
    {
        if (isset($data['recurrent'], $data['periodicity'], $data['periodicity_parent_id'])) {
            return RecurrentInvoice::createFromArray($data);
        }

        return Invoice::createFromArray($data);
    }
}
