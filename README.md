FlowcodeFinancialBundle
=============

The FlowcodeFinancialBundle brings you a model for basic financial and accounting features.


Documentation
-------------

The source of the documentation is stored in the `Resources/doc/` folder
in this bundle:

[Read the Documentation for master](https://github.com/flowcode/financial-bundle/blob/master/src/Flowcode/FinancialBundle/Resources/doc/index.rst)

To make financeService work properly you have to add this mappings

document -> transaction
document -> paymentDocument
```
Document:
  type: entity
  oneToMany:
    transactions:
      targetEntity: Flowcode\FinancialBundle\Entity\Core\Transaction
      mappedBy: document
    paymentsDocuments:
      targetEntity: Flowcode\FinancialBundle\Entity\Payment\PaymentDocument
      mappedBy: document
```
payment -> paymentDocument
```
Payment:
  type: entity
  oneToMany:
    paymentDocuments:
      targetEntity: Flowcode\FinancialBundle\Entity\Payment\PaymentDocument
      mappedBy: payment
```
transaction -> journalEntries
```
Transaction:
  type: entity
  oneToMany:
    journalEntries:
      targetEntity: Flowcode\FinancialBundle\Entity\Core\JournalEntry
      mappedBy: transaction
```
