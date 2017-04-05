<?php

namespace Flowcode\FinancialBundle\Model\Document;

use Flowcode\FinancialBundle\Model\Document\DocumentItemInterface;

/**
 * Interface Flowcode\FinancialBundle\Model\Document\DocumentInterface
 */
interface DocumentInterface
{

    /**
     * Add items
     */
    public function addItem(DocumentItemInterface $items);
    /**
     * Remove items
     */
    public function removeItem(DocumentItemInterface $items);

    /**
     * Get items
     */
    public function getItems();
}
