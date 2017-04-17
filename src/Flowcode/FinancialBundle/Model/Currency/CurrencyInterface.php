<?php

namespace Flowcode\FinancialBundle\Model\Currency;

interface CurrencyInterface
{

    public function getId();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();
}
