<?php

namespace Flowcode\FinancialBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;
use Flowcode\FinancialBundle\Model\Core\TransactionInterface;
use Flowcode\FinancialBundle\Model\Manager\TransactionManagerInterface;
use Flowcode\FinancialBundle\Model\Payment\ExpenseInterface;
use Flowcode\FinancialBundle\Model\Payment\IncomeInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;
use Flowcode\FinancialBundle\Model\Manager\InstanceManagerInterface;

/**
 * Class TransactionService
 */
class TransactionService implements TransactionManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $instanceManagerInterface;

    public function __construct(InstanceManagerInterface $instanceManagerInterface)
    {
        $this->instanceManagerInterface = $instanceManagerInterface;
    }

    /**
     * @param IncomeInterface $income
     * @param PaymentMethodInterface $paymentMethod
     * @param $amount
     * @return mixed
     */
    public function createIncomeTrx(IncomeInterface $income, PaymentMethodInterface $paymentMethod, $amount)
    {
        //Ingreso
        $journalEntryIncome = $this->instanceManagerInterface->getInstanceFromInterface(JournalEntryInterface::class);
        //Activo
        $journalEntryAsset = $this->instanceManagerInterface->getInstanceFromInterface(JournalEntryInterface::class);
        /**
         * @var TransactionInterface $transaction
         */
        $transaction = $this->instanceManagerInterface->getInstanceFromInterface(TransactionInterface::class);
        $journalEntryIncome->setCredit($amount);
        $journalEntryIncome->setAccount($income->getAccount());
        $journalEntryAsset->setDebit($amount);
        $journalEntryAsset->setAccount($paymentMethod->getAccount());
        $transaction->addJournalEntry($journalEntryIncome);
        $transaction->addJournalEntry($journalEntryAsset);
        return $transaction;
    }

    /**
     * @param ExpenseInterface $expense
     * @param PaymentMethodInterface $paymentMethod
     * @param $amount
     * @return mixed
     */
    public function createExpenseTrx(ExpenseInterface $expense, PaymentMethodInterface $paymentMethod, $amount)
    {
        //Egreso
        $journalEntryExpense = $this->instanceManagerInterface->getInstanceFromInterface(JournalEntryInterface::class);
        //Activo
        $journalEntryAsset = $this->instanceManagerInterface->getInstanceFromInterface(JournalEntryInterface::class);
        /**
         * @var TransactionInterface $transaction
         */
        $transaction = $this->instanceManagerInterface->getInstanceFromInterface(TransactionInterface::class);
        $journalEntryExpense->setDebit($amount);
        $journalEntryExpense->setAccount($expense->getAccount());
        $journalEntryAsset->setCredit($amount);
        $journalEntryAsset->setAccount($paymentMethod->getAccount());
        $transaction->addJournalEntry($journalEntryExpense);
        $transaction->addJournalEntry($journalEntryAsset);
        return $transaction;
    }
}
