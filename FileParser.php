<?php

require_once 'PriceLookup.php';

class FileParser
{

    /**
     * SUMMARY
     * Takes a file and returns each line as an object with named keys.
     *
     * DESCRIPTION
     * The input file is a history of Vinted orders in .txt format. 
     * Each new line represents a new order, with a space " " seperating each peice of order data. 
     * The data one each line must follow this pattern: DATE SIZE CARRIER.
     * For example: 2015-02-10 S MR
     * 
     * The return vale is an array of assoc. arrays (objects), where each assoc. array has named keys for each data in the line
     * The standard price of that order is also added to the array
     * For example, this line is the input file: 2015-02-10 S MR
     * would become:  
     *  [
     *      'date' => '2015-02-10',
     *      'size' => 'S',
     *      'carrier' => 'MR',
     *      'price' => '2'
     *  ]
     */
    public static function read($file)
    {
        $lines = file($file);
        
        $fileAsObjectArray = [];
        foreach ($lines as $line) {
            $lineObject = array();
            $lineAsArray = explode(" ", trim($line));
            if (isset($lineAsArray[0])){
                $lineObject['date'] = $lineAsArray[0];
            }
            if (isset($lineAsArray[1])){
                $lineObject['size'] = $lineAsArray[1];
            }
            if (isset($lineAsArray[2])){
                $lineObject['carrier'] = $lineAsArray[2];
            }
            if (!isset($lineObject['date']) || !isset($lineObject['size']) || !isset($lineObject['carrier'])){
                $lineObject['ignore'] = true;
            }
            $lineObject['price'] = PriceLookup::getPrice($lineObject);
            $lineObject['discount'] = '-';
            $fileAsObjectArray[] = $lineObject;
        }
        return $fileAsObjectArray;
    }
}