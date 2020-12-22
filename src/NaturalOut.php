<?php

// Class  for commission fees calculation natural person cash out transaction

namespace App;

class NaturalOut extends PersonalTransaction implements supportedTransactions
/**
     * @param string $date  
     * @param string $currentAmount
     * @param string $currencyName
     * 
     * Class  for commission fees calculation natural person cash out transaction
     */
{

    public function calculateCommission($currentDate, $currentAmount, $currencyName)
    {
        $this->currencyName = $currencyName;
        $this->setExchangeRatio();
        $this->currentDate = $currentDate;
        $this->currentAmount = $currentAmount;
        $chargedValue = $this->currentAmount * $this->exchangeRatio;
        $this->updatePersonTransactionDataBefore();
        $weekAmount = $this->weekTransactionAmount * $this->exchangeRatio;
        $weekCount = $this->weekTransactionCount;

        if ($weekAmount > 1000 || $weekCount > 3) {
            $euroCommission =  $chargedValue * 0.003;
        } else {
            if ((1000 >= ($chargedValue +  $weekAmount)) && $weekCount <= 3) {
                $euroCommission =  0;
            }
            if ((1000 <= ($chargedValue +  $weekAmount)) && $weekCount <= 3) {
                $euroCommission = (($chargedValue +  $weekAmount - 1000) * 0.003);
            }
        }

        $this->commission = $euroCommission / $this->exchangeRatio;
        if ($this->currencyName === 'JPY') {
            $this->commission = floor($this->commission*-1)*-1;
        } else {
            $this->commission = number_format($this->commission, 2, '.', '');
        }
        $this->changeLastTransactionDate();
        $this->updatePersonTransactionDataAfter();
    }
}
