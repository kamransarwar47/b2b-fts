<?php

namespace App\src\Transaction;

use App\src\Account\Account;

class TransferTransaction implements TransactionsInterface
{
    private $account_from;
    private $account_to;
    private $amount;

    public function __construct($amount, Account $account_from, Account $account_to)
    {
        $this->account_from = $account_from;
        $this->account_to = $account_to;
        $this->amount = $amount;
    }

    public function processTransaction()
    {
        $withdrawal_transaction = new WithdrawalTransaction($this->amount, $this->account_from);
        $withdrawal_transaction->processTransaction();
        $deposit_transaction = new DepositTransaction($this->amount, $this->account_to);
        $deposit_transaction->processTransaction();
        return true;
    }
}