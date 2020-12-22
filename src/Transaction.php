<?php

namespace App;

abstract class Transaction

{
    public $transactionType;
    public $currencyName;
    public $transactionAmount;
    public $transactionDate;
    public $exchangeRatio;
    public $commission;
    public $pastTransactionDate;

    function __construct()
    {
        $this->exchangeRatio;
        $this->commission;
        $this->weekTransactionCount;
        $this->weekTransactionAmount;
        $this->pastTransactionDate;
    }

    abstract public function setExchangeRatio();
}
