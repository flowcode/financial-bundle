Getting Started With FinancialBundle
====================================


Interfaces
~~~~~~~~~~

Configure the entities witch will implement the models.

.. code-block:: yaml

    # app/config/config.yml

    doctrine:
    # ...
    orm:
        # ...
        resolve_target_entities:
            Flowcode\FinancialBundle\Model\Core\AccountInterface: AppBundle\Entity\Account
            Flowcode\FinancialBundle\Model\Core\JournalEntryInterface: AppBundle\Entity\JournalEntry
            Flowcode\FinancialBundle\Model\Core\TransactionInterface: AppBundle\Entity\Transaction