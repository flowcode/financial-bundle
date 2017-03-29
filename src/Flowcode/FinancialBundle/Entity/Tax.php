<?php

namespace Flowcode\FinancialBundle\Entity;

/**
 * Tax
 */
class Tax
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $rate;

    /**
     * @var bool
     */
    protected $forSale;

    /**
     * @var bool
     */
    protected $forPurchase;

    /**
     * @var string
     */
    protected $description;


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
     * Set name
     *
     * @param string $name
     *
     * @return Tax
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set rate
     *
     * @param float $rate
     *
     * @return Tax
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
     * Set forSale
     *
     * @param boolean $forSale
     *
     * @return Tax
     */
    public function setForSale($forSale)
    {
        $this->forSale = $forSale;

        return $this;
    }

    /**
     * Get forSale
     *
     * @return bool
     */
    public function getForSale()
    {
        return $this->forSale;
    }

    /**
     * Set forPurchase
     *
     * @param boolean $forPurchase
     *
     * @return Tax
     */
    public function setForPurchase($forPurchase)
    {
        $this->forPurchase = $forPurchase;

        return $this;
    }

    /**
     * Get forPurchase
     *
     * @return bool
     */
    public function getForPurchase()
    {
        return $this->forPurchase;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Tax
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
}

