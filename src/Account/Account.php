<?php

namespace App\src\Account;

class Account
{
    private $accountId;
    private $balance;
    private $transactions = [];

    /**
     * @param $accountId
     * @param $initialBalance
     */
    public function __construct($accountId, $initialBalance = 0) {
        $this->accountId = $accountId;
        $this->balance = $initialBalance;
    }

    public function getAccountId()
    {
        return $this->accountId;
    }

    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function setTransactions($transactions)
    {
        $this->transactions[] = $transactions;
    }

    public function getTransactions()
    {
        return $this->transactions;
    }

    public function getAccountDetails()
    {
        return [
            'account_id' => $this->getAccountId(),
            'balance' => $this->getBalance(),
            'transactions' => $this->getTransactions()
        ];
    }
}