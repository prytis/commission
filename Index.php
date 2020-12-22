<?php

namespace App;

require 'vendor/autoload.php';

// Load Csv file into array $currencyTransactions
$currencyTransactions = new LoadCsv($argv[1]);

foreach ($currencyTransactions->data as $i => $_) {

  // seting up key for class name selection for further commission calculation
  $transactionType = $currencyTransactions->data[$i][2]
    . $currencyTransactions->data[$i][3];

  // seting up reference to personal transaction object
  $person = 'person' . $currencyTransactions->data[$i][3]
    . $currencyTransactions->data[$i][1];

  // cerating particulat person transaction instance
  if (!isset($$person)) {
    $$person = SetCommisionFeeClass::selectClass(
      $transactionType,
      $currencyTransactions->data[$i][0],
      $currencyTransactions->data[$i][4],
      $currencyTransactions->data[$i][5],
      $person
    );
  }
  // comission fee calculation
  $$person->calculateCommission(
    $currencyTransactions->data[$i][0],
    $currencyTransactions->data[$i][4],
    $currencyTransactions->data[$i][5]
  );

  // stdout results printed out
  print_r($$person->commission);
  print_r("\n");
}
