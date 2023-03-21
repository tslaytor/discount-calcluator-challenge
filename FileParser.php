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
     * The standard price of that order is added to the array, as well as the default discount (i.e. '-');
     * For example, this line is the input file: 2015-02-10 S MR
     * would become:  
     *  [
     *      'ignore' => 'false',
     *      'date' => '2015-02-10',
     *      'size' => 'S',
     *      'carrier' => 'MR',
     *      'price' => '2',
     *      'discount' => '-'
     *  ]
     */

    public static function read($file)
    {
        $lines = file($file);
        
        $fileAsObjectArray = [];
        foreach ($lines as $line) {
            $lineAsArray = explode(" ", trim($line));
            $lineObject = array();
            $lineObject['ignore'] = true;
            if (count($lineAsArray) === 3) {
                // validate date
                $validDate = false;
                $dateArray = explode("-", $lineAsArray[0]);
                if (count($dateArray) === 3){
                    $validDate = checkdate($dateArray[1], $dateArray[2], $dateArray[0]);
                }
                // valid size
                $validSize = $lineAsArray[1] === 'S' || $lineAsArray[1] === 'M' || $lineAsArray[1] === 'L';
                //validate carrier
                $validCarrier = $lineAsArray[2] === 'LP' || $lineAsArray[2] === 'MR';
                if ($validDate && $validSize && $validCarrier){
                    $lineObject['ignore'] = false;
                }
            }
            
            if ($lineObject['ignore'] === false){
                $lineObject['date'] = $lineAsArray[0];
                $lineObject['size'] = $lineAsArray[1];
                $lineObject['carrier'] = $lineAsArray[2];
                $lineObject['price'] = PriceLookup::getPrice($lineObject);
                $lineObject['discount'] = '0.00';
            }
            else {
                $lineObject['unchanged'] = trim($line);
            }
            $fileAsObjectArray[] = $lineObject;
        }
        return $fileAsObjectArray;
    }
}