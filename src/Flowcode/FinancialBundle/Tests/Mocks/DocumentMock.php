<?php
namespace Flowcode\FinancialBundle\Tests\Mocks;

use Flowcode\FinancialBundle\Entity\Document\Document as BaseDocument;
use Flowcode\FinancialBundle\Model\Document\DocumentInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Flowcode\FinancialBundle\Tests\Mocks\DocumentMock
 */
class DocumentMock extends BaseDocument implements DocumentInterface
{
    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->transactions = new ArrayCollection();
        $this->paymentsDocuments = new ArrayCollection();
    }
}
