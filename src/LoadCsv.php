<?php

namespace App;

class LoadCsv
/**
 * Class  for csv file loading into array
*/

{
    public $data = [];
    private $pointer = 0;
    public function __construct($handle)
    {
        $this->handle = $handle;
        $this->openCsv();
    }

    private function openCsv()
    {
        $handle = fopen($this->handle, "r");
        while (!feof($handle)) {
            array_push($this->data, fgetcsv($handle));
        }
        fclose($handle);
    }
}
