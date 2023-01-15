<?php

namespace App\src;

use App\src\Account\Account;
use App\src\TransactionSorter\TransactionsSortedByComment;
use App\src\TransactionSorter\TransactionsSortedByDate;

class AccountsManager
{
    private $accounts = [];

    public function registerAccount(Account $account)
    {
        $this->accounts[$account->getAccountId()] = $account;
    }

    public function performTransaction($transaction_type, $comment, $amount, $date, $account_from, $account_to = null)
    {
        $transaction = new TransactionsManager($transaction_type, $comment, $amount, $date, $account_from, $account_to);
        $transaction->process();
    }

    public function getAllAccounts()
    {
        $accounts = [];
        foreach ($this->accounts as $account) {
            $accounts[] = $account->getAccountDetails();
        }
        return $accounts;
    }

    public function getBalanceOfSpecificAccount(Account $account)
    {
        return $this->accounts[$account->getAccountId()]->getBalance();
    }

    public function getAllAccountTransactionsSortedByComment()
    {
        $transactionSorter = new TransactionSorter(new TransactionsSortedByComment());
        return $transactionSorter->applySorting($this->accounts);
    }

    public function getAllAccountTransactionsSortedByDate()
    {
        $transactionSorter = new TransactionSorter(new TransactionsSortedByDate());
        return $transactionSorter->applySorting($this->accounts);
    }
}
