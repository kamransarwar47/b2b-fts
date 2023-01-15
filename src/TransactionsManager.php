<?php

namespace App\src;

use App\src\Account\Account;

class TransactionsManager
{
    private $comment;
    private $amount;
    private $date;
    private $type;
    private $account_from;
    private $account_to;

    public function __construct($type, $comment, $amount, $date, $account_from, $account_to)
    {
        $this->comment = $comment;
        $this->amount = $amount;
        $this->date = $date;
        $this->type = $type;
        $this->account_from = $account_from;
        $this->account_to = $account_to;
    }

    public function process()
    {
        try {
            $className = 'App\\src\\Transaction\\'.ucwords($this->type).'Transaction';
            if(!class_exists( $className)) {
                throw new \Exception('File with '.$className.' could not be found');
            }
            if(is_null($this->account_to)) {
                $transaction = new $className($this->amount, $this->account_from);
            } else {
                $transaction = new $className($this->amount, $this->account_from, $this->account_to);
            }
            if($transaction->processTransaction()) {
                $this->addTransactionToAccount($this->account_from);
                if(!is_null($this->account_to)) {
                    $this->addTransactionToAccount($this->account_to);
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage().PHP_EOL;
        }
    }

    private function addTransactionToAccount(Account $account) {
        $account->setTransactions([
            'comment' => $this->comment,
            'amount' => $this->amount,
            'date' => $this->date
        ]);
    }
}