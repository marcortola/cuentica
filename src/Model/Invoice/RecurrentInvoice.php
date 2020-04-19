<?php declare(strict_types=1);

namespace MarcOrtola\Cuentica\Model\Invoice;

class RecurrentInvoice extends Invoice
{
    private int $periodicity;
    private int $periodicityParentId;

    /**
     * @param InvoiceLine[] $invoiceLines
     * @param Charge[] $charges
     */
    public function __construct(
        bool $issued,
        array $invoiceLines,
        array $charges,
        int $periodicity,
        int $periodicityParentId
    ) {
        parent::__construct($issued, $invoiceLines, $charges);
        $this->periodicity = $periodicity;
        $this->periodicityParentId = $periodicityParentId;
    }

    public function getPeriodicity(): ?int
    {
        return $this->periodicity;
    }

    public function getPeriodicityParentId(): ?int
    {
        return $this->periodicityParentId;
    }

    public static function createFromArray(array $data): RecurrentInvoice
    {
        if (!isset($data['recurrent'], $data['periodicity'], $data['periodicity_parent_id'])) {
            throw new \InvalidArgumentException();
        }

        $invoice = parent::createFromArray($data);

        $recurrentInvoice = new self(
            $invoice->isIssued(),
            $invoice->getInvoiceLines(),
            $invoice->getCharges(),
            $data['periodicity'],
            $data['periodicity_parent_id']
        );

        $recurrentInvoice->setId($invoice->getId());
        $recurrentInvoice->setBusiness($invoice->getBusiness());
        $recurrentInvoice->setCustomer($invoice->getCustomer());
        $recurrentInvoice->setIrm($invoice->getIrm());
        $recurrentInvoice->setAnnotations($invoice->getAnnotations());
        $recurrentInvoice->setDescription($invoice->getDescription());
        $recurrentInvoice->setDate($invoice->getDate());
        $recurrentInvoice->setFooter($invoice->getFooter());
        $recurrentInvoice->setAmountDetails($invoice->getAmountDetails());
        $recurrentInvoice->setInvoiceNumber($invoice->getInvoiceNumber());
        $recurrentInvoice->setInvoiceSerie($invoice->getInvoiceSerie());
        $recurrentInvoice->setRectificationCause($invoice->getRectificationCause());
        $recurrentInvoice->setRectifiedInvoice($invoice->getRectifiedInvoice());

        foreach ($invoice->getTags() as $tag) {
            $recurrentInvoice->addTag($tag);
        }

        return $recurrentInvoice;
    }
}
