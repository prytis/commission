<?php

namespace App;


// interface supportedTransactions
// {
//     public function calculateCommission($transactionDate, $transactionAmount, $currencyName);
// }
class SetCommisionFeeClass
{
    protected static $lookup = [
        'naturalcash_in' => CashIn::class,
        'naturalcash_out' => NaturalOut::class,
        'legalcash_out' => LegalOut::class,
        'legalcash_in' => CashIn::class,
    ];
    public static function selectClass(
        $transactionType,
        $transactionDate,
        $transactionAmount,
        $currencyName,
        $personId
    ) {
        $class = isset(static::$lookup[$transactionType])
            ? static::$lookup[$transactionType] : PersonalTransaction::class;
        return new $class($personId, $transactionDate, $transactionAmount, $currencyName);
    }
}
