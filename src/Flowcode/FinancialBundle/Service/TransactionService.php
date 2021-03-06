<?php

namespace Flowcode\FinancialBundle\Service;

use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;
use Flowcode\FinancialBundle\Model\Core\TransactionInterface;
use Flowcode\FinancialBundle\Model\Manager\TransactionManagerInterface;
use Flowcode\FinancialBundle\Model\Payment\ExpenseInterface;
use Flowcode\FinancialBundle\Model\Payment\IncomeInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentDocumentInterface;
use Flowcode\FinancialBundle\Model\Manager\InstanceManagerInterface;
use Flowcode\FinancialBundle\Model\Manager\AccountManagerInterface;
use Flowcode\FinancialBundle\Model\Manager\JournalEntityManagerInterface;
use Flowcode\FinancialBundle\Model\Core\AccountInterface;
use Flowcode\FinancialBundle\Model\Currency\CurrencyInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;

/**
 * Class TransactionService
 */
class TransactionService implements TransactionManagerInterface {

    /**
     * @var InstanceManagerInterface
     */
    protected $instanceService;

    public function __construct(
    InstanceManagerInterface $instanceService, AccountManagerInterface $accountService, JournalEntityManagerInterface $journalEntityService
    ) {
        $this->instanceService = $instanceService;
        $this->accountService = $accountService;
        $this->journalEntityService = $journalEntityService;
    }

    /**
     * Creación de movimientos para una venta instantanea
     * @param IncomeInterface $income
     * @param PaymentDocumentInterface $paymentDocument
     * @param $amount
     * @return mixed
     */
    public function createIncomeTrx(
    IncomeInterface $income, CurrencyInterface $currency, PaymentDocumentInterface $paymentDocument, $amount
    ) {
        //Ingreso
        $journalEntryIncome = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);
        //Activo
        $journalEntryAsset = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);

        $accountIncome = $this->getAccountIncomeCurrency($income, $currency);
        $accountPaymentMethod = $this->getAccountPaymentMethodCurrency($paymentDocument->getPayment()->getMethod(), $currency);
        /**
         * @var TransactionInterface $transaction
         */
        $transaction = $this->instanceService->getInstanceFromInterface(TransactionInterface::class);
        $journalEntryIncome->setCredit($amount);
        $journalEntryIncome->setAccount($accountIncome);
        $journalEntryIncome->setDate(new \DateTime());
        $journalEntryIncome->setTransaction($transaction);

        $journalEntryAsset->setDebit($amount);
        $journalEntryAsset->setAccount($accountPaymentMethod);
        $journalEntryAsset->setDate(new \DateTime());
        $journalEntryAsset->setTransaction($transaction);

        $paymentDocument->setJournalEntry($journalEntryAsset);
        $transaction->addJournalEntry($journalEntryIncome);
        $transaction->addJournalEntry($journalEntryAsset);
        $transaction->setDate(new \DateTime());
        return $transaction;
    }

    /**
     * @param ExpenseInterface $expense
     * @param PaymentDocumentInterface $paymentDocument
     * @param $amount
     * @return mixed
     */
    public function createExpenseTrx(
    ExpenseInterface $expense, CurrencyInterface $currency, PaymentDocumentInterface $paymentDocument, $amount
    ) {
        //Egreso
        $journalEntryExpense = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);
        //Activo
        $journalEntryAsset = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);

        $accountExpense = $this->getAccountExpenseCurrency($expense, $currency);
        $accountPaymentMethod = $this->getAccountPaymentMethodCurrency($paymentDocument->getPayment()->getMethod(), $currency);

        /**
         * @var TransactionInterface $transaction
         */
        $transaction = $this->instanceService->getInstanceFromInterface(TransactionInterface::class);
        $journalEntryExpense->setDebit($amount);
        $journalEntryExpense->setAccount($accountExpense);
        $journalEntryExpense->setDate(new \DateTime());
        $journalEntryExpense->setTransaction($transaction);

        $journalEntryAsset->setCredit($amount);
        $journalEntryAsset->setAccount($accountPaymentMethod);
        $journalEntryAsset->setDate(new \DateTime());
        $journalEntryAsset->setTransaction($transaction);

        $transaction->addJournalEntry($journalEntryExpense);
        $transaction->addJournalEntry($journalEntryAsset);
        $transaction->setDate(new \DateTime());

        return $transaction;
    }

    public function updateBalancesByTransaction(TransactionInterface $transaction) {
        foreach ($transaction->getJournalEntries() as $journal) {
            $this->journalEntityService->updateBalance($journal);
        }
    }

    /**
     * Creación de movimientos para una venta que va a ser pagada en un futuro.
     * @param IncomeInterface $income
     * @param AccountInterface $clientAccount
     * @param $amount
     * @return mixed
     */
    public function createSaleOrderTrx(
    IncomeInterface $income, CurrencyInterface $currency, AccountInterface $clientAccount, $amount
    ) {
        //Ingreso
        $journalEntryIncome = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);
        //Activo Cuenta del cliente que debe
        $journalEntryAsset = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);

        $accountIncome = $this->getAccountIncomeCurrency($income, $currency);

        /**
         * @var TransactionInterface $transaction
         */
        $transaction = $this->instanceService->getInstanceFromInterface(TransactionInterface::class);
        $journalEntryIncome->setCredit($amount);
        $journalEntryIncome->setAccount($accountIncome);
        $journalEntryIncome->setDate(new \DateTime());
        $journalEntryIncome->setTransaction($transaction);

        $journalEntryAsset->setDebit($amount);
        $journalEntryAsset->setAccount($clientAccount);
        $journalEntryAsset->setDate(new \DateTime());
        $journalEntryAsset->setTransaction($transaction);

        $transaction->addJournalEntry($journalEntryIncome);
        $transaction->addJournalEntry($journalEntryAsset);
        $transaction->setDate(new \DateTime());

        return $transaction;
    }

    /**
     * Creación de movimientos de pago de una deuda de un cliente.
     * @param AccountInterface $clientAccount
     * @param PaymentDocumentInterface $paymentDocument
     * @param $amount
     * @return mixed
     */
    public function createSaleOrderPaymentTrx(
    AccountInterface $clientAccount, CurrencyInterface $currency, PaymentDocumentInterface $paymentDocument, $amount
    ) {
        //Ingreso
        $journalEntryIncome = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);
        //Activo Cuenta del cliente que debe
        $journalEntryAsset = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);

        $accountPaymentMethod = $this->getAccountPaymentMethodCurrency($paymentDocument->getPayment()->getMethod(), $currency);

        /**
         * @var TransactionInterface $transaction
         */
        $transaction = $this->instanceService->getInstanceFromInterface(TransactionInterface::class);
        $journalEntryIncome->setDebit($amount);
        $journalEntryIncome->setAccount($accountPaymentMethod);
        $journalEntryIncome->setDate(new \DateTime());
        $journalEntryIncome->setTransaction($transaction);

        $paymentDocument->setJournalEntry($journalEntryIncome);
        $journalEntryAsset->setCredit($amount);
        $journalEntryAsset->setAccount($clientAccount);
        $journalEntryAsset->setDate(new \DateTime());
        $journalEntryAsset->setTransaction($transaction);

        $transaction->addJournalEntry($journalEntryIncome);
        $transaction->addJournalEntry($journalEntryAsset);
        $transaction->setDate(new \DateTime());

        return $transaction;
    }

    /**
     * @param ExpenseInterface $expense
     * @param PaymentDocumentInterface $paymentDocument
     * @param $amount
     * @return mixed
     */
    public function createExpenseAccountTrx(
    AccountInterface $clientAccount, CurrencyInterface $currency, PaymentDocumentInterface $paymentDocument, $amount
    ) {
        //Egreso
        $journalEntryExpense = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);
        //Activo
        $journalEntryAsset = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);

        $accountPaymentMethod = $this->getAccountPaymentMethodCurrency($paymentDocument->getPayment()->getMethod(), $currency);

        /**
         * @var TransactionInterface $transaction
         */
        $transaction = $this->instanceService->getInstanceFromInterface(TransactionInterface::class);
        $journalEntryExpense->setDebit($amount);
        $journalEntryExpense->setAccount($clientAccount);
        $journalEntryExpense->setDate(new \DateTime());
        $journalEntryExpense->setTransaction($transaction);

        $journalEntryAsset->setCredit($amount);
        $journalEntryAsset->setAccount($accountPaymentMethod);
        $journalEntryAsset->setDate(new \DateTime());
        $journalEntryAsset->setTransaction($transaction);

        $transaction->addJournalEntry($journalEntryExpense);
        $transaction->addJournalEntry($journalEntryAsset);
        $transaction->setDate(new \DateTime());

        return $transaction;
    }

    private function getAccountIncomeCurrency(IncomeInterface $income, CurrencyInterface $currency) {
        $accountIncome = null;
        foreach ($income->getAccounts() as $currentAccount) {
            if ($currentAccount->getCurrency()->getId() == $currency->getId()) {
                $accountIncome = $currentAccount;
            }
        }
        if ($accountIncome == null) {
            throw new \InvalidArgumentException("account:income:not:found");
        }
        return $accountIncome;
    }

    private function getAccountExpenseCurrency(ExpenseInterface $expense, CurrencyInterface $currency) {
        $accountExpense = null;

        foreach ($expense->getAccounts() as $currentAccount) {
            if ($currentAccount->getCurrency()->getId() == $currency->getId()) {
                $accountExpense = $currentAccount;
            }
        }
        if ($accountExpense == null) {
            throw new \InvalidArgumentException("account:expense:not:found");
        }
        return $accountExpense;
    }

    private function getAccountPaymentMethodCurrency(PaymentMethodInterface $paymentMethod, CurrencyInterface $currency) {
        $accountPaymentMethod = null;

        foreach ($paymentMethod->getAccounts() as $currentAccount) {
            if ($currentAccount->getCurrency()->getId() == $currency->getId()) {
                $accountPaymentMethod = $currentAccount;
            }
        }
        if ($accountPaymentMethod == null) {
            throw new \InvalidArgumentException("account:payment:method:not:found");
        }
        return $accountPaymentMethod;
    }

    public function revertTrx(TransactionInterface $trx) {
        $revertTransaction = $this->instanceService->getInstanceFromInterface(TransactionInterface::class);
        foreach ($trx->getJournalEntries() as $journalEntry) {
            $journalEntryRevert = $this->instanceService->getInstanceFromInterface(JournalEntryInterface::class);
            $journalEntryRevert->setAccount($journalEntry->getAccount());
            $journalEntryRevert->setDate(new \DateTime());
            $journalEntryRevert->setTransaction($revertTransaction);
            if ($journalEntry->getDebit() > 0) {
                $journalEntryRevert->setCredit($journalEntry->getDebit());
            }
            if ($journalEntry->getCredit() > 0) {
                $journalEntryRevert->setDebit($journalEntry->getCredit());
            }
            $revertTransaction->addJournalEntry($journalEntryRevert);
        }
        $revertTransaction->setDate(new \DateTime());
        $this->updateBalancesByTransaction($revertTransaction);
        return $revertTransaction;
    }

}
