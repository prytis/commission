<?php

use App\SetCommisionFeeClass;


class Cash extends \PHPUnit\Framework\TestCase
{
    /**
     * @param string $transactionType  
     * @param string $transactionDate
     * @param string $transactionAmount
     * @param string $currencyName
     * @param string $personId
     * 
     * testCashIn test function  for NaturalChash class testing
     */

    function testCashIn()
    {
        // first commission calculation instance created for natural person cash_in transaction
        $person = SetCommisionFeeClass::selectClass(
            'legalcash_out',
            '2014-12-31',
            '1200',
            'EUR',
            '1'
        );

        $person->calculateCommission('2014-12-31', '1200', 'EUR');
        $this->assertEquals($person->commission, '3.60');


        $person->calculateCommission('2015-01-01', '315000', 'JPY');
        $this->assertEquals($person->commission, '7.30');
    }
}
