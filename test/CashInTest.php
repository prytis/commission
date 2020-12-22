<?php

use App\SetCommisionFeeClass;


class LegalOut extends \PHPUnit\Framework\TestCase
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

    function testLegalOut()
    {
        // first commission calculation instance created for legal person cash_out transaction
        $person = SetCommisionFeeClass::selectClass(
            'naturalcash_in',
            '2014-12-31',
            '1200',
            'EUR',
            '1'
        );

        $person->calculateCommission('2014-12-31', '1200', 'EUR');
        $this->assertEquals($person->commission, '0.36');


        $person->calculateCommission('2015-01-01', '1000', 'EUR');
        $this->assertEquals($person->commission, '0.30');
    }
}
