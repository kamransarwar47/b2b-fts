<?php

namespace App\src\Transaction;

use App\src\Account\Account;

class WithdrawalTransaction implements TransactionsInterface
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
        $accountBalance -= $this->amount;
        if($accountBalance < 0) {
            throw new \Exception('Not enough balance in account');
        }
        $this->account->setBalance($accountBalance);
        return true;
    }
}