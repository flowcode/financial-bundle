<?php

namespace Flowcode\FinancialBundle\Model\Manager;

use Flowcode\FinancialBundle\Model\Payment\ExpenseInterface;
use Flowcode\FinancialBundle\Model\Payment\IncomeInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;

/**
 * Interface InstanceManagerInterface
 */
interface InstanceManagerInterface
{

    public function getInstanceFromInterface(String $classInterface);
}
