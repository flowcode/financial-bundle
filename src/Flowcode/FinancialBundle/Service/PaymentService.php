<?php

namespace Flowcode\FinancialBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Flowcode\FinancialBundle\Model\Manager\PaymentManagerInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentInterface;
use Flowcode\FinancialBundle\Model\Manager\InstanceManagerInterface;

/**
 * Class PaymentService
 */
class PaymentService implements PaymentManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $instanceManagerInterface;

    public function __construct(InstanceManagerInterface $instanceManagerInterface)
    {
        $this->instanceManagerInterface = $instanceManagerInterface;
    }

    public function createPayment(PaymentMethodInterface $paymentMethod, $amount)
    {
        $payment = $this->instanceManagerInterface->getInstanceFromInterface(PaymentInterface::class);
        $payment->setAmount($amount);
        $payment->setMethod($paymentMethod);
        return $payment;
    }
}
