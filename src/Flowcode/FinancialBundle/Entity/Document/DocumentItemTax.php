<?php

namespace Flowcode\FinancialBundle\Entity\Document;

use Flowcode\FinancialBundle\Model\Document\DocumentItemInterface;
use Flowcode\FinancialBundle\Model\TaxInterface;

/**
 * DocumentItemTax
 */
abstract class DocumentItemTax
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var DocumentItemInterface
     */
    protected $documentItem;

    /**
     * @var TaxInterface
     */
    protected $tax;

    /**
     * @var float
     */
    protected $rate;

    /**
     * @var float
     */
    protected $amount;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rate
     *
     * @param float $rate
     *
     * @return DocumentItemTax
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return DocumentItemTax
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return DocumentItemInterface
     */
    public function getDocumentItem(): DocumentItemInterface
    {
        return $this->documentItem;
    }

    /**
     * @param DocumentItemInterface $documentItem
     */
    public function setDocumentItem(DocumentItemInterface $documentItem)
    {
        $this->documentItem = $documentItem;
    }

    /**
     * @return TaxInterface
     */
    public function getTax(): TaxInterface
    {
        return $this->tax;
    }

    /**
     * @param TaxInterface $tax
     */
    public function setTax(TaxInterface $tax)
    {
        $this->tax = $tax;
    }


}

