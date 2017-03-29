<?php

namespace Flowcode\FinancialBundle\Model\Payment;

/**
 * Payment
 */
class Payment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $type;

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
     * Set type
     *
     * @param string $type
     *
     * @return Payment
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Payment
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

