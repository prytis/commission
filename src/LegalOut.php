<?php

namespace App;

class LegalOut extends PersonalTransaction implements supportedTransactions
{
     /**
     * @param string $date  
     * @param string $currentAmount
     * @param string $currencyName
     * 
     * Class  for commission fees calculation legal person cash out transaction
     */

    public function calculateCommission($date, $currentAmount, $currencyName)
    {
        $this->currencyName = $currencyName;
        $this->setExchangeRatio();
        $this->currentAmount = $currentAmount;
        $this->commission = $this->currentAmount * $this->exchangeRatio * 0.003;
        if ($this->commission < 0.5) {
            $this->commission = 0.5;
        }
        $this->commission = number_format($this->commission, 2, '.', '');
    }
}
