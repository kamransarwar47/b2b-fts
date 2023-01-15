<?php

namespace App\src\Transaction;

use App\src\Account\Account;

class DepositTransaction implements TransactionsInterface
{
    private $account;
    private $amount;

    public function __construct($amount, Account $account)
    {
        $this->account = $account;
        $this->amount = $amount;
    }

    public function processTransaction()
    {
        $accountBalance = $this->account->getBalance();
        $accountBalance += $this->amount;
        $this->account->setBalance($accountBalance);
        return true;
    }
}