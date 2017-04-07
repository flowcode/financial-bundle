<?php

namespace Flowcode\FinancialBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Flowcode\FinancialBundle\Model\Core\JournalEntryInterface;
use Flowcode\FinancialBundle\Model\Core\TransactionInterface;
use Flowcode\FinancialBundle\Model\Manager\InstanceManagerInterface;
use Flowcode\FinancialBundle\Model\Payment\ExpenseInterface;
use Flowcode\FinancialBundle\Model\Payment\IncomeInterface;
use Flowcode\FinancialBundle\Model\Payment\PaymentMethodInterface;

/**
 * Class InstanceService
 */
class InstanceService implements InstanceManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    public function getInstanceFromInterface(String $classInterface)
    {
        $metadata = $this->entityManager->getClassMetadata($classInterface);
        $realClassName = $metadata->getName();

        $class = new \ReflectionClass($realClassName);

        return $class->newInstance();
    }
}
