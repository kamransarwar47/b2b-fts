<?php

namespace App\src;

use App\src\TransactionSorter\TransactionSorterInterface;

class TransactionSorter
{
    private $sorter;

    public function __construct(TransactionSorterInterface $sorter)
    {
        $this->sorter = $sorter;
    }

    public function applySorting($account)
    {
        return $this->sorter->sort($account);
    }
}