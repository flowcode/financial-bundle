<?php

namespace Flowcode\FinancialBundle\Model;

/**
 * Tax
 */
class Tax
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $rate;

    /**
     * @var bool
     */
    private $forSale;

    /**
     * @var bool
     */
    private $forPurchase;

    /**
     * @var string
     */
    private $description;


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

