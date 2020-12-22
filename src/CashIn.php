<?php

namespace App;

class CashIn extends PersonalTransaction implements supportedTransactions

    /**
     * @param string $date  
     * @param string $currentAmount
     * @param string $currencyName
     * 
     * Class  for commission fees calculation natural person cash in transaction
     */
{
    public function calculateCommission($date, $currentAmount, $currencyName)
    {
        $this->currencyName = $currencyName;
        $this->setExchangeRatio();
        $this->currentAmount = $currentAmount;
        $this->commission = $this->currentAmount * $this->exchangeRatio * 0.0003;
        if ($this->commission > 5) {
            $this->commission = 5;
        }
        $this->commission = number_format($this->commission, 2, '.', '');
    }
}
