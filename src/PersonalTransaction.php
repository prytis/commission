<?php

namespace App;

interface supportedTransactions
{
    public function calculateCommission($transactionDate, $transactionAmount, $currencyName);
}

class PersonalTransaction extends Transaction
{
    public $iD;
    public $weekTransactionCount;
    public $weekTransactionAmount;

    function __construct($iD, $transactionDate, $transactionAmount, $currencyName)
    {
        $this->iD = $iD;
        $this->transactionDate = $transactionDate;
        $this->pastTransactionDate = date('Y-m-d', strtotime('-10 day', strtotime($transactionDate)));
        $this->currentAmount = $transactionAmount;
        $this->currencyName = $currencyName;
        $this->setExchangeRatio();
    }
    public function setExchangeRatio()
    {
        if ($this->currencyName === "USD") {
            $this->exchangeRatio = 1 / 1.497;
        } elseif ($this->currencyName === "JPY") {
            $this->exchangeRatio = 1 / 129.53;
        } else {
            $this->exchangeRatio = 1;
        }
    }
    public function updatePersonTransactionDataBefore()
    {
        if (!$this->checkSameWeek()) {
            $this->weekTransactionCount = 0;
            $this->weekTransactionAmount = 0;
        }
    }
    public function updatePersonTransactionDataAfter()
    {
        if ($this->checkSameWeek()) {
            $this->weekTransactionCount++;
            $this->weekTransactionAmount += $this->currentAmount * $this->exchangeRatio;
        }
    }
    public function changeLastTransactionDate()
    {
        $this->pastTransactionDate = $this->currentDate;
    }
    public function checkSameWeek()
    {
        $d1 = strtotime($this->pastTransactionDate);
        $d2 = strtotime($this->currentDate);

        if (round($d2 / 604800) - round($d1 / 604800) == 0) {
            return true;
        }
        return false;
    }
}
