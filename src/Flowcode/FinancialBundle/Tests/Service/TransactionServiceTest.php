<?php

namespace Flowcode\FinancialBundle\Tests\Service;

use Flowcode\FinancialBundle\Tests\BaseTestCase;
use Flowcode\FinancialBundle\Service\TransactionService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Flowcode\FinancialBundle\Entity\Core\JournalEntry;
use Flowcode\FinancialBundle\Entity\Core\Transaction;
use Flowcode\FinancialBundle\Entity\Core\Account;
use Flowcode\FinancialBundle\Entity\Payment\Income;
use Flowcode\FinancialBundle\Entity\Payment\PaymentMethod;
use Flowcode\FinancialBundle\Entity\Payment\PaymentDocument;
use Flowcode\FinancialBundle\Service\InstanceService;
use Flowcode\FinancialBundle\Service\AccountService;
use Flowcode\FinancialBundle\Service\JournalEntityService;
use Flowcode\FinancialBundle\Entity\Payment\Expense;
use Flowcode\FinancialBundle\Entity\Payment\Payment;
use Flowcode\FinancialBundle\Entity\Currency\Currency;

class TransactionServiceTest extends BaseTestCase
{

    /**
     * Probamos que al enviar una cuenta de income, paymentmethod y amount se cree una entidad
     * de transaccion con la las journalEntities correctas para un ingreso.
     * @fecha   2017-04-04
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @version [version]
     * @return  [type]                  [description]
     */
    public function testCreateIncomeTransaction_returnTransactionWithJournalEntites()
    {
        $income = $this->getMockBuilder(Income::class)
                ->getMockForAbstractClass();
        $incomeFinantialAccount = $this->getMockBuilder(Account::class)
                ->getMockForAbstractClass();

        $currency = $this->getMockBuilder(Currency::class)
                ->setMethods(['getId'])
                ->getMockForAbstractClass();
        $currency
                ->method('getId')
                ->willReturn(1);
        $incomeFinantialAccount->setCurrency($currency);

        $income->addAccount($incomeFinantialAccount);

        $paymentMethodFinantialAccount = $this->getMockBuilder(Account::class)
                ->getMockForAbstractClass();
        $paymentMethod = $this->getMockBuilder(PaymentMethod::class)
                ->getMockForAbstractClass();

        $paymentMethodFinantialAccount->setCurrency($currency);
        $paymentMethod->addAccount($paymentMethodFinantialAccount);

        $payment = $this->getMockBuilder(Payment::class)
                ->getMockForAbstractClass();
        $payment->setMethod($paymentMethod);

        $paymentDocument = $this->getMockBuilder(PaymentDocument::class)
                ->getMockForAbstractClass();
        $paymentDocument->setPayment($payment);

        $instanceManagerInterface = $this->getMockBuilder(InstanceService::class)
                ->disableOriginalConstructor()
                ->getMock();

        $transactionService = $this->getTransactionService();
        $amount = 1000;
        $transaction2 = $transactionService->createIncomeTrx($income, $currency, $paymentDocument, $amount);

        $this->assertEquals(0, $transaction2->getJournalEntries()[0]->getDebit());
        $this->assertEquals($amount, $transaction2->getJournalEntries()[0]->getCredit());
        $this->assertEquals($incomeFinantialAccount, $transaction2->getJournalEntries()[0]->getAccount());

        $this->assertEquals($amount, $transaction2->getJournalEntries()[1]->getDebit());
        $this->assertEquals(0, $transaction2->getJournalEntries()[1]->getCredit());
        $this->assertEquals($paymentMethodFinantialAccount, $transaction2->getJournalEntries()[1]->getAccount());
    }

    /**
     * Probamos que al enviar una cuenta de expense, paymentmethod y amount se cree una entidad
     * de transaccion con la las journalEntities correctas para un gasto.
     * @fecha   2017-04-04
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @version [version]
     * @return  [type]                  [description]
     */
    public function testCreateExpenseTransaction_returnTransactionWithJournalEntites()
    {
        $expense = $this->getMockBuilder(Expense::class)
                ->getMockForAbstractClass();
        $expenseFinantialAccount = $this->getMockBuilder(Account::class)
                ->getMockForAbstractClass();

        $currency = $this->getMockBuilder(Currency::class)
                ->setMethods(['getId'])
                ->getMockForAbstractClass();
        $currency
                ->method('getId')
                ->willReturn(1);
        $expenseFinantialAccount->setCurrency($currency);

        $expense->addAccount($expenseFinantialAccount);

        $paymentMethodFinantialAccount = $this->getMockBuilder(Account::class)
                ->getMockForAbstractClass();
        $paymentMethod = $this->getMockBuilder(PaymentMethod::class)
                ->getMockForAbstractClass();

        $paymentMethodFinantialAccount->setCurrency($currency);
        $paymentMethod->addAccount($paymentMethodFinantialAccount);


        $payment = $this->getMockBuilder(Payment::class)
                ->getMockForAbstractClass();
        $payment->setMethod($paymentMethod);

        $paymentDocument = $this->getMockBuilder(PaymentDocument::class)
                ->getMockForAbstractClass();
        $paymentDocument->setPayment($payment);

        $instanceManagerInterface = $this->getMockBuilder(InstanceService::class)
                ->disableOriginalConstructor()
                ->getMock();
        $callBack = $this->getMockCallbackForGetInstanceFromInterface();
        $instanceManagerInterface
                ->method('getInstanceFromInterface')
                ->will($this->returnCallback($callBack));

        $transactionService = $this->getTransactionService();
        $amount = 1000;
        $transaction2 = $transactionService->createExpenseTrx($expense, $currency, $paymentDocument, $amount);

        $this->assertEquals($amount, $transaction2->getJournalEntries()[0]->getDebit());
        $this->assertEquals(0, $transaction2->getJournalEntries()[0]->getCredit());
        $this->assertEquals($expenseFinantialAccount, $transaction2->getJournalEntries()[0]->getAccount());

        $this->assertEquals(0, $transaction2->getJournalEntries()[1]->getDebit());
        $this->assertEquals($amount, $transaction2->getJournalEntries()[1]->getCredit());
        $this->assertEquals($paymentMethodFinantialAccount, $transaction2->getJournalEntries()[1]->getAccount());
    }

    /**
     * Probamos que al enviar una cuenta de income, un cliente y amount se cree una entidad
     * de transaccion con la las journalEntities correctas para un ingreso que se va a cobrar mas tarde.
     * @fecha   2017-04-04
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @version [version]
     * @return  [type]                  [description]
     */
    public function testCreateIncomeSaleOrderTransaction_returnTransactionWithJournalEntites()
    {
        $income = $this->getMockBuilder(Income::class)
                ->getMockForAbstractClass();
        $incomeFinantialAccount = $this->getMockBuilder(Account::class)
                ->getMockForAbstractClass();

        $currency = $this->getMockBuilder(Currency::class)
                ->setMethods(['getId'])
                ->getMockForAbstractClass();
        $currency
                ->method('getId')
                ->willReturn(1);
        $incomeFinantialAccount->setCurrency($currency);

        $income->addAccount($incomeFinantialAccount);

        $clientAccount = $this->getMockBuilder(Account::class)
                ->getMockForAbstractClass();

        $instanceManagerInterface = $this->getMockBuilder(InstanceService::class)
                ->disableOriginalConstructor()
                ->getMock();

        $transactionService = $this->getTransactionService();
        $amount = 1000;
        $transaction2 = $transactionService->createSaleOrderTrx($income, $currency, $clientAccount, $amount);

        $this->assertEquals(0, $transaction2->getJournalEntries()[0]->getDebit());
        $this->assertEquals($amount, $transaction2->getJournalEntries()[0]->getCredit());
        $this->assertEquals($incomeFinantialAccount, $transaction2->getJournalEntries()[0]->getAccount());

        $this->assertEquals($amount, $transaction2->getJournalEntries()[1]->getDebit());
        $this->assertEquals(0, $transaction2->getJournalEntries()[1]->getCredit());
        $this->assertEquals($clientAccount, $transaction2->getJournalEntries()[1]->getAccount());
    }

    /**
     * Probamos que al enviar una cuenta de cliente, un paymentDocument y amount se cree una entidad
     * de transaccion con la las journalEntities correctas que indican el pago de un documento.
     * @fecha   2017-04-04
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @version [version]
     * @return  [type]                  [description]
     */
    public function testCreateIncomeSaleOrderPaymentTransaction_returnTransactionWithJournalEntites()
    {
        $paymentMethodFinantialAccount = $this->getMockBuilder(Account::class)
                ->getMockForAbstractClass();
        $paymentMethod = $this->getMockBuilder(PaymentMethod::class)
                ->getMockForAbstractClass();

        $currency = $this->getMockBuilder(Currency::class)
                ->setMethods(['getId'])
                ->getMockForAbstractClass();
        $currency
                ->method('getId')
                ->willReturn(1);

        $paymentMethodFinantialAccount->setCurrency($currency);
        $paymentMethod->addAccount($paymentMethodFinantialAccount);

        $payment = $this->getMockBuilder(Payment::class)
                ->getMockForAbstractClass();
        $payment->setMethod($paymentMethod);

        $paymentDocument = $this->getMockBuilder(PaymentDocument::class)
                ->getMockForAbstractClass();
        $paymentDocument->setPayment($payment);

        $clientAccount = $this->getMockBuilder(Account::class)
                ->getMockForAbstractClass();

        $instanceManagerInterface = $this->getMockBuilder(InstanceService::class)
                ->disableOriginalConstructor()
                ->getMock();

        $transactionService = $this->getTransactionService();
        $amount = 1000;
        $transaction2 = $transactionService->createSaleOrderPaymentTrx($clientAccount, $currency, $paymentDocument, $amount);

        $this->assertEquals(0, $transaction2->getJournalEntries()[1]->getDebit());
        $this->assertEquals($amount, $transaction2->getJournalEntries()[1]->getCredit());
        $this->assertEquals($clientAccount, $transaction2->getJournalEntries()[1]->getAccount());

        $this->assertEquals($amount, $transaction2->getJournalEntries()[0]->getDebit());
        $this->assertEquals(0, $transaction2->getJournalEntries()[0]->getCredit());
        $this->assertEquals($paymentMethodFinantialAccount, $transaction2->getJournalEntries()[0]->getAccount());
    }

    /**
     * Probamos que al enviar una cuenta de un cliente, paymentmethod y amount se cree una entidad
     * de transaccion con la las journalEntities correctas para un gasto.
     * @fecha   2017-04-04
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @version [version]
     * @return  [type]                  [description]
     */
    public function testCreateExpenseClientTransaction_returnTransactionWithJournalEntites()
    {
        $clientFinantialAccount = $this->getMockBuilder(Account::class)
                ->getMockForAbstractClass();

        $currency = $this->getMockBuilder(Currency::class)
                ->setMethods(['getId'])
                ->getMockForAbstractClass();
        $currency
                ->method('getId')
                ->willReturn(1);
        $clientFinantialAccount->setCurrency($currency);

        $paymentMethodFinantialAccount = $this->getMockBuilder(Account::class)
                ->getMockForAbstractClass();
        $paymentMethod = $this->getMockBuilder(PaymentMethod::class)
                ->getMockForAbstractClass();

        $paymentMethodFinantialAccount->setCurrency($currency);
        $paymentMethod->addAccount($paymentMethodFinantialAccount);


        $payment = $this->getMockBuilder(Payment::class)
                ->getMockForAbstractClass();
        $payment->setMethod($paymentMethod);

        $paymentDocument = $this->getMockBuilder(PaymentDocument::class)
                ->getMockForAbstractClass();
        $paymentDocument->setPayment($payment);

        $instanceManagerInterface = $this->getMockBuilder(InstanceService::class)
                ->disableOriginalConstructor()
                ->getMock();
        $callBack = $this->getMockCallbackForGetInstanceFromInterface();
        $instanceManagerInterface
                ->method('getInstanceFromInterface')
                ->will($this->returnCallback($callBack));

        $transactionService = $this->getTransactionService();
        $amount = 1000;
        $transaction2 = $transactionService->createExpenseAccountTrx($clientFinantialAccount, $currency, $paymentDocument, $amount);

        $this->assertEquals($amount, $transaction2->getJournalEntries()[0]->getDebit());
        $this->assertEquals(0, $transaction2->getJournalEntries()[0]->getCredit());
        $this->assertEquals($clientFinantialAccount, $transaction2->getJournalEntries()[0]->getAccount());

        $this->assertEquals(0, $transaction2->getJournalEntries()[1]->getDebit());
        $this->assertEquals($amount, $transaction2->getJournalEntries()[1]->getCredit());
        $this->assertEquals($paymentMethodFinantialAccount, $transaction2->getJournalEntries()[1]->getAccount());
    }

    private function getTransactionService()
    {
        $instanceManagerInterface = $this->getMockBuilder(InstanceService::class)
                ->disableOriginalConstructor()
                ->getMock();
        $accountManagerInterface = $this->getMockBuilder(AccountService::class)
                ->disableOriginalConstructor()
                ->getMock();
        $journalEntityManagerInterface = $this->getMockBuilder(JournalEntityService::class)
                ->disableOriginalConstructor()
                ->getMock();
        $callBack = $this->getMockCallbackForGetInstanceFromInterface();
        $instanceManagerInterface
                ->method('getInstanceFromInterface')
                ->will($this->returnCallback($callBack));
        return new TransactionService($instanceManagerInterface, $accountManagerInterface, $journalEntityManagerInterface);
    }

    private function getMockCallbackForGetInstanceFromInterface()
    {
        return (
                function ($class)
                {
                    if ($class == "Flowcode\FinancialBundle\Model\Core\JournalEntryInterface") {
                        return $this->getMockBuilder(JournalEntry::class)
                                        ->getMockForAbstractClass();
                    }
                    return $this->getMockBuilder('Flowcode\FinancialBundle\Entity\Core\Transaction')
                                    ->getMockForAbstractClass();
                }
                );
    }

}
