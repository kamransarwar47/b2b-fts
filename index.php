<?php
require 'vendor/autoload.php';

use App\src\Account\Account;
use App\src\AccountsManager;


$account_1 = new Account(101, 100);
$account_2 = new Account(102);
$account_3 = new Account(103, 400);

$accountManager = new AccountsManager();
$accountManager->registerAccount($account_1);
$accountManager->registerAccount($account_2);
$accountManager->registerAccount($account_3);

$accountManager->performTransaction(
    'transfer',
    'Transfer -> 50 -> Account 1 -> Account 2',
    50,
    date('Y-m-d H:i:s', time()),
    $account_1,
    $account_2
);
sleep(1);
$accountManager->performTransaction(
    'deposit',
    'Deposit -> 50 -> Account 1',
    50,
    date('Y-m-d H:i:s', time()),
    $account_1
);
sleep(1);
$accountManager->performTransaction(
    'withdrawal',
    'Withdrawal -> 50',
    50,
    date('Y-m-d H:i:s', time()),
    $account_3
);

print_r($accountManager->getAllAccounts());
print_r($accountManager->getBalanceOfSpecificAccount($account_1));
print_r($accountManager->getAllAccountTransactionsSortedByComment());
print_r($accountManager->getAllAccountTransactionsSortedByDate());