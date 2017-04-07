<?php

namespace Flowcode\FinancialBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Flowcode\FinancialBundle\Model\Manager\PaymentDocumentManagerInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentInterface;
use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentDocumentInterface;
use Flowcode\FinancialBundle\Model\Manager\InstanceManagerInterface;

/**
 * Class PaymentDocumentService
 */
class PaymentDocumentService implements PaymentDocumentManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $instanceManagerInterface;

    public function __construct(InstanceManagerInterface $instanceManagerInterface)
    {
        $this->instanceManagerInterface = $instanceManagerInterface;
    }

    public function createPaymentDocumentForPayment(
        PaymentInterface $payment,
        $amount
    ) {
        $paymentDoc = $this->instanceManagerInterface->getInstanceFromInterface(PaymentDocumentInterface::class);
        $paymentDoc->setAmount($amount);
        $paymentDoc->setPayment($payment);
        return $paymentDoc;
    }
}
