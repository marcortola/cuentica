<?php

namespace MarcOrtola\Cuentica\Model\Invoice;

use MarcOrtola\Cuentica\Model\Arrayable;
use MarcOrtola\Cuentica\Model\Assert;
use MarcOrtola\Cuentica\Model\CreatableFromArray;
use MarcOrtola\Cuentica\Model\Customer\Customer;
use MarcOrtola\Cuentica\Model\Customer\CustomerFactory;

/**
 * @implements CreatableFromArray<self>
 */
class Invoice implements Arrayable, CreatableFromArray
{
    private ?int $id = null;
    private ?Customer $business = null;
    private ?Customer $customer = null;
    private ?string $irm = null;
    private ?string $annotations = null;
    private ?string $description = null;
    private ?string $date = null;
    private ?string $footer = null;
    private ?AmountDetails $amountDetails = null;
    private ?int $invoiceNumber = null;
    private ?string $invoiceSerie = null;
    private ?string $rectificationCause = null;
    private ?self $rectifiedInvoice = null;
    private bool $issued;
    /**
     * @var InvoiceLine[]
     */
    private array $invoiceLines;
    /**
     * @var Charge[]
     */
    private array $charges;
    /**
     * @var Tag[]
     */
    private array $tags = [];

    /**
     * @param InvoiceLine[] $invoiceLines
     * @param Charge[] $charges
     */
    public function __construct(bool $issued, array $invoiceLines, array $charges)
    {
        $this->issued = $issued;
        $this->invoiceLines = $invoiceLines;
        $this->charges = $charges;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getBusiness(): ?Customer
    {
        return $this->business;
    }

    public function setBusiness(?Customer $business): void
    {
        $this->business = $business;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getIrm(): ?string
    {
        return $this->irm;
    }

    public function setIrm(?string $irm): void
    {
        $this->irm = $irm;
    }

    public function getAnnotations(): ?string
    {
        return $this->annotations;
    }

    public function setAnnotations(?string $annotations): void
    {
        $this->annotations = $annotations;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): void
    {
        if (null !== $date) {
            Assert::dateString($date);
        }

        $this->date = $date;
    }

    public function getFooter(): ?string
    {
        return $this->footer;
    }

    public function setFooter(?string $footer): void
    {
        $this->footer = $footer;
    }

    public function getAmountDetails(): ?AmountDetails
    {
        return $this->amountDetails;
    }

    public function setAmountDetails(?AmountDetails $amountDetails): void
    {
        $this->amountDetails = $amountDetails;
    }

    public function getInvoiceNumber(): ?int
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(?int $invoiceNumber): void
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    public function getInvoiceSerie(): ?string
    {
        return $this->invoiceSerie;
    }

    public function setInvoiceSerie(?string $invoiceSerie): void
    {
        $this->invoiceSerie = $invoiceSerie;
    }

    public function getRectificationCause(): ?string
    {
        return $this->rectificationCause;
    }

    public function setRectificationCause(?string $rectificationCause): void
    {
        $this->rectificationCause = $rectificationCause;
    }

    public function getRectifiedInvoice(): ?self
    {
        return $this->rectifiedInvoice;
    }

    public function setRectifiedInvoice(?self $rectifiedInvoice): void
    {
        $this->rectifiedInvoice = $rectifiedInvoice;
    }

    public function isIssued(): bool
    {
        return $this->issued;
    }

    /**
     * @return InvoiceLine[]
     */
    public function getInvoiceLines(): array
    {
        return $this->invoiceLines;
    }

    public function addInvoiceLine(InvoiceLine $invoiceLine): void
    {
        if (!\in_array($invoiceLine, $this->invoiceLines, true)) {
            $this->invoiceLines[] = $invoiceLine;
        }
    }

    /**
     * @return Charge[]
     */
    public function getCharges(): array
    {
        return $this->charges;
    }

    public function addCharge(Charge $charge): void
    {
        if (!\in_array($charge, $this->charges, true)) {
            $this->charges[] = $charge;
        }
    }

    /**
     * @return Tag[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): void
    {
        if (!\in_array($tag, $this->tags, true)) {
            $this->tags[] = $tag;
        }
    }

    public function removeTag(Tag $tag): void
    {
        if (\in_array($tag, $this->tags, true)) {
            $this->tags = array_diff($this->tags, [$tag]);
        }
    }

    public function toArray(): array
    {
        $data = [];

        $data['issued'] = $this->issued;

        foreach ($this->invoiceLines as $invoiceLine) {
            $data['invoice_lines'][] = $invoiceLine->toArray();
        }

        foreach ($this->charges as $charge) {
            $data['charges'][] = $charge->toArray();
        }

        foreach ($this->getTags() as $tag) {
            $data['tags'][] = $tag->getName();
        }

        if (null !== $this->id) {
            $data['id'] = $this->id;
        }

        if (null !== $this->business) {
            $data['business'] = $this->business->toArray();
        }

        if (null !== $this->customer) {
            $data['customer'] = $this->customer->toArray();
        }

        if (null !== $this->amountDetails) {
            $data['amount_details'] = $this->amountDetails->toArray();
        }

        if (null !== $this->rectifiedInvoice) {
            $data['rectified_invoice'] = $this->rectifiedInvoice->toArray();
        }

        if (null !== $this->irm) {
            $data['irm'] = $this->irm;
        }

        if (null !== $this->annotations) {
            $data['annotations'] = $this->annotations;
        }

        if (null !== $this->description) {
            $data['description'] = $this->description;
        }

        if (null !== $this->date) {
            $data['date'] = $this->date;
        }

        if (null !== $this->footer) {
            $data['footer'] = $this->footer;
        }

        if (null !== $this->invoiceNumber) {
            $data['invoice_number'] = $this->invoiceNumber;
        }

        if (null !== $this->invoiceSerie) {
            $data['invoice_serie'] = $this->invoiceSerie;
        }

        if (null !== $this->rectificationCause) {
            $data['rectification_cause'] = $this->rectificationCause;
        }

        return $data;
    }

    public static function createFromArray(array $data): Invoice
    {
        if (!isset($data['issued'], $data['invoice_lines'], $data['charges']) || !\is_array($data['invoice_lines']) || !\is_array($data['charges'])) {
            throw new \InvalidArgumentException();
        }

        $invoice = new self($data['issued'], [], []);

        foreach ($data['invoice_lines'] as $invoiceLine) {
            $invoice->addInvoiceLine(InvoiceLine::createFromArray($invoiceLine));
        }

        foreach ($data['charges'] as $charge) {
            $invoice->addCharge(Charge::createFromArray($charge));
        }

        foreach ($data['tags'] as $tag) {
            $invoice->addTag(Tag::createFromArray($tag));
        }

        $invoice->business = isset($data['business']) ? CustomerFactory::createFromArray($data['business']) : null;
        $invoice->customer = isset($data['customer']) ? CustomerFactory::createFromArray($data['customer']) : null;
        $invoice->amountDetails = isset($data['amount_details']) ? AmountDetails::createFromArray($data['amount_details']) : null;
        $invoice->rectifiedInvoice = isset($data['rectified_invoice']) ? Invoice::createFromArray($data['rectified_invoice']) : null;
        $invoice->id = $data['id'] ?? null;
        $invoice->irm = $data['irm'] ?? null;
        $invoice->annotations = $data['annotations'] ?? null;
        $invoice->description = $data['description'] ?? null;
        $invoice->date = $data['date'] ?? null;
        $invoice->footer = $data['footer'] ?? null;
        $invoice->invoiceNumber = $data['invoice_number'] ?? null;
        $invoice->invoiceSerie = $data['invoice_serie'] ?? null;
        $invoice->rectificationCause = $data['rectification_cause'] ?? null;

        return $invoice;
    }
}
