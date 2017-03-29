<?php

namespace Flowcode\FinancialBundle\Entity\Document;

/**
 * DocumentItemTax
 */
abstract class DocumentItemTax
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $rate;

    /**
     * @var float
     */
    private $amount;


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
}

