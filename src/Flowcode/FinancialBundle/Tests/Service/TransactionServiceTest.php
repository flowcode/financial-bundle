<?php

namespace Flowcode\FinancialBundle\Tests\Service;

use Flowcode\FinancialBundle\Tests\BaseTestCase;
use Flowcode\FinancialBundle\Service\TransactionService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Flowcode\FinancialBundle\Entity\Core\JournalEntry;
use Flowcode\FinancialBundle\Entity\Core\Transaction;

class TransactionServiceTest extends BaseTestCase
{
    /**
     * Probamos que al enviar ina cuenta de income, paymentmethod y amount se cree una entidad
     * de transaccion con la las journalEntities correctas.
     * @fecha   2017-04-04
     * @author Francisco Memoli Olmos
     * @email   fmemoli@flowcode.com.ar
     * @version [version]
     * @return  [type]                  [description]
     */
    public function testCreateIncomeTransaction_returnTransactionWithJournalEntites()
    {
        $income = $this->getMockBuilder('Flowcode\FinancialBundle\Entity\Payment\Income')
            ->getMockForAbstractClass();
        $paymentMethod = $this->getMockBuilder('Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface')
            ->getMockForAbstractClass();
        $instanceManagerInterface = $this->getMockBuilder('Flowcode\FinancialBundle\Service\InstanceService')
                                        ->disableOriginalConstructor()
                                        ->getMock();
        $callBack = $this->getMockCallbackForGetInstanceFromInterface();
        $instanceManagerInterface
             ->method('getInstanceFromInterface')
             ->will($this->returnCallback($callBack));
        
        $transactionService = new TransactionService($instanceManagerInterface);
        $amount = 1000;
        $transaction2 = $transactionService->createIncomeTrx($income, $paymentMethod, $amount);

        $this->assertEquals(0, $transaction2->getJournalEntries()[0]->getDebit());
        $this->assertEquals(1000, $transaction2->getJournalEntries()[0]->getCredit());

        $this->assertEquals(1000, $transaction2->getJournalEntries()[1]->getDebit());
        $this->assertEquals(0, $transaction2->getJournalEntries()[1]->getCredit());
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
