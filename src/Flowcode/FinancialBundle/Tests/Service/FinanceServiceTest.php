<?php

namespace Flowcode\FinancialBundle\Tests\Service;

use Flowcode\FinancialBundle\Tests\BaseTestCase;
use Flowcode\FinancialBundle\Service\FinanceService;
use Flowcode\FinancialBundle\Service\TransactionService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Flowcode\FinancialBundle\Entity\Core\JournalEntry;
use Flowcode\FinancialBundle\Entity\Core\Transaction;
use Flowcode\FinancialBundle\Entity\Core\Account;
use Flowcode\FinancialBundle\Entity\Payment\Income;
use Flowcode\FinancialBundle\Entity\Payment\PaymentMethod;
use Flowcode\FinancialBundle\Service\InstanceService;
use Flowcode\FinancialBundle\Entity\Payment\Expense;
use Flowcode\FinancialBundle\Entity\Document\Document;

class FinanceServiceTest extends BaseTestCase
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
    public function testCreateInstantSale_returnDocumentWithCorrectInformation()
    {
        $document = $this->getMockBuilder(Document::class)
                         ->getMockForAbstractClass();
        $income = $this->getMockBuilder(Income::class)
                       ->getMockForAbstractClass();
        $incomeFinantialAccount = $this->getMockBuilder(Account::class)
                                       ->getMockForAbstractClass();
        $income->setAccount($incomeFinantialAccount);

        $paymentMethod = $this->getMockBuilder(PaymentMethod::class)
                              ->getMockForAbstractClass();
        $paymentMethodFinantialAccount = $this->getMockBuilder(Account::class)
                                              ->getMockForAbstractClass();
        $paymentMethod->setAccount($paymentMethodFinantialAccount);

        $paymentService = $this->getMockBuilder(PaymentService::class)
                               ->getMockForAbstractClass();

        $documentService = $this->getMockBuilder(DocumentService::class)
                                ->getMockForAbstractClass();
        $transactionService = $this->getMockBuilder(TransactionService::class)
                                ->getMockForAbstractClass();

        $financeService = new FinanceService($transactionService, $documentService, $paymentService);
        $amount = 1000;
        $document = $financeService->createInstantSale($document, $income, $paymentMethod);

        $this->assertEquals(0, $transaction2->getJournalEntries()[0]->getDebit());
        $this->assertEquals(1000, $transaction2->getJournalEntries()[0]->getCredit());
        $this->assertEquals($incomeFinantialAccount, $transaction2->getJournalEntries()[0]->getAccount());

        $this->assertEquals(1000, $transaction2->getJournalEntries()[1]->getDebit());
        $this->assertEquals(0, $transaction2->getJournalEntries()[1]->getCredit());
        $this->assertEquals($paymentMethodFinantialAccount, $transaction2->getJournalEntries()[1]->getAccount());
    }
    
    private function getMockCallbackForGetInstanceFromInterface()
    {
        return (
            function ($class) {
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
