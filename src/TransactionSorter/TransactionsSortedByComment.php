<?php

namespace App\src\TransactionSorter;

class TransactionsSortedByComment implements TransactionSorterInterface
{
    public function sort($accounts)
    {
        $transactions = [];
        foreach ($accounts as $account) {
            $transactions = array_merge($transactions, $account->getTransactions());
        }
        usort($transactions, function ($a, $b) {
            return strcmp($a['comment'], $b['comment']);
        });
        return $transactions;
    }
}