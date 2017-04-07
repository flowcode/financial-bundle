<?php

namespace Flowcode\FinancialBundle\Model\Manager;

use Flowcode\FinancialBundle\Model\Core\AccountInterface;

/**
 * Interface AccountManagerInterface
 */
interface AccountManagerInterface
{

    public function updateBalance(AccountInterface $accountInterface);
    
}
