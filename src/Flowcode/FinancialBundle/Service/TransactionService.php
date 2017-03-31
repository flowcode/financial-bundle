<?php

namespace Flowcode\FinancialBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;
use Flowcode\FinancialBundle\Model\Core\TransactionInterface;
use Flowcode\FinancialBundle\Model\Manager\TransactionManagerInterface;
use Flowcode\FinancialBundle\Model\Payment\ExpenseInterface;
use Flowcode\FinancialBundle\Model\Payment\IncomeInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;

/**
 * Class TransactionService
 */
class TransactionService implements TransactionManagerInterface
{

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param IncomeInterface $income
     * @param PaymentMethodInterface $paymentMethod
     * @param $amount
     * @return mixed
     */
    function createIncomeTrx(IncomeInterface $income, PaymentMethodInterface $paymentMethod, $amount)
    {

        /**
         * @var JournalEntryInterface $journalEntry1
         */
        $journalEntry1 = $this->getInstanceFromInterface(JournalEntryInterface::class);


        /**
         * @var TransactionInterface $transaction
         */
        $transaction = $this->getInstanceFromInterface(TransactionInterface::class);

        $transaction->addJournalEntry($journalEntry1);

        
        return $transaction;

    }

    private function getInstanceFromInterface($classInterface)
    {
        $metadata = $this->entityManager->getClassMetadata($classInterface);
        $realClassName = $metadata->getName();

        $class = new \ReflectionClass($realClassName);

        return $class->newInstance();
    }

    /**
     * @param ExpenseInterface $expense
     * @param PaymentMethodInterface $paymentMethod
     * @param $amount
     * @return mixed
     */
    function createExpenseTrx(ExpenseInterface $expense, PaymentMethodInterface $paymentMethod, $amount)
    {
        // TODO: Implement createExpenseTrx() method.
    }
}