<?php

namespace App\src\TransactionSorter;

interface TransactionSorterInterface
{
    public function sort($account);
}