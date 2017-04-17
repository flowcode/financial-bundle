<?php

namespace Flowcode\FinancialBundle\Entity\Currency;

use Flowcode\FinancialBundle\Model\Currency\CurrencyInterface;

/**
 * Currency
 */
abstract class Currency implements CurrencyInterface
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
     * @return CurrencyInterface
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }
}
