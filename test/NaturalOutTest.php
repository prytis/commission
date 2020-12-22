<?php

use App\SetCommisionFeeClass;


class NaturalOut extends \PHPUnit\Framework\TestCase
{
     /**
     * @param string $transactionType  
     * @param string $transactionDate
     * @param string $transactionAmount
     * @param string $currencyName
     * @param string $personId
     * 
     * testNaturalOut test function  for NaturalOut class testing
     */
    function testNaturalOut()
    {
        // first commission calculation instace created for natural person cash_out transaction
        $person = SetCommisionFeeClass::selectClass(
            'naturalcash_out',
            '2014-12-31',
            '1200',
            'EUR',
            '1'
          );
        
        $person->calculateCommission('2014-12-31','1200','EUR');
        $this->assertEquals($person->commission, '0.60');
       
        $person->updatePersonTransactionDataBefore();   
        $person->calculateCommission('2015-01-01','1000','EUR');
        $this->assertEquals($person->commission, '3.00');

        $person->updatePersonTransactionDataBefore();   
        $person->calculateCommission('2015-01-05','1000','EUR');
        $this->assertEquals($person->commission, '0.00');

        $person->updatePersonTransactionDataBefore();   
        $person->calculateCommission('2015-01-05','500','EUR');
        $this->assertEquals($person->commission, '1.50');

        $person->updatePersonTransactionDataBefore();   
        $person->calculateCommission('2015-01-12','200','EUR');
        $this->assertEquals($person->commission, '0.00');

        $person->updatePersonTransactionDataBefore();   
        $person->calculateCommission('2015-01-12','500','EUR');
        $this->assertEquals($person->commission, '0.00');
        $person->updatePersonTransactionDataAfter();

        $person->updatePersonTransactionDataBefore();   
        $person->calculateCommission('2015-01-12','850','USD');
        $this->assertEquals($person->commission, '1.66');
        $person->updatePersonTransactionDataAfter();

        $person->updatePersonTransactionDataBefore();   
        $person->calculateCommission('2015-01-12','30000','JPY');
        $this->assertEquals($person->commission, '90.00');
        $person->updatePersonTransactionDataAfter();
 
       
    }
}
