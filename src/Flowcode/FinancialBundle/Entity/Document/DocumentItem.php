<?php

namespace Flowcode\FinancialBundle\Entity\Document;

use Flowcode\FinancialBundle\Model\Document\DocumentInterface;

/**
 * DocumentItem
 */
abstract class DocumentItem
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var DocumentInterface
     */
    protected $document;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var int
     */
    protected $units;

    /**
     * @var TaxInterface
     */
    protected $taxs;

    /**
     * @var float
     */
    protected $unitPrice;

    /**
     * @var float
     * (units * price) + tax
     */
    protected $total;


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
     * Set description
     *
     * @param string $description
     *
     * @return DocumentItem
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set units
     *
     * @param integer $units
     *
     * @return DocumentItem
     */
    public function setUnits($units)
    {
        $this->units = $units;

        return $this;
    }

    /**
     * Get units
     *
     * @return int
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * Set unitPrice
     *
     * @param float $unitPrice
     *
     * @return DocumentItem
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * Get unitPrice
     *
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * Set total
     *
     * @param float $total
     *
     * @return DocumentItem
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return DocumentInterface
     */
    public function getDocument(): DocumentInterface
    {
        return $this->document;
    }

    /**
     * @param DocumentInterface $document
     */
    public function setDocument(DocumentInterface $document)
    {
        $this->document = $document;
    }
}
