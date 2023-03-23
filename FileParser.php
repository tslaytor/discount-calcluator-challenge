<?php

require_once 'PriceLookup.php';
require_once 'Valid.php';

class FileParser
{

    /**
     * SUMMARY
     * Takes a .txt file of orders and returns an array of objects, where each object represents an order
     *
     * DESCRIPTION
     * The input file is a history of orders in .txt format, with each order seperated by a new line. 
     * If the format and values of an order are valid, the object is marked as valid and keys are added for each attribute value.
     * If the input in invalid, the object is marked as invalid.
     * 
     * RETURN VALUE EXAMPLES
     * 
     * valid input example
     * input: "2015-02-10 S MR"
     * output: {
     *          'original_input' => '2015-02-10 S MR',
     *          'valid' => 'true',
     *          'date' => '2015-02-10',
     *          'size' => 'S',
     *          'carrier' => 'MR',
     *          'price' => '2',
     *          'discount' => '0.00' // standard discount before any discount rules are applied
     *          }
     * 
     * invalid input example
     * input: "2015-55-10 SM MR"
     * output: {
     *          'original_input' => '2015-55-10 SM MR',
     *          'valid' => 'false',
     *          }
     */

    public static function parse($file)
    {
        $returnArray = [];
        $orders = file($file);
        foreach ($orders as $order) {
            $orderObject = array();
            $orderObject['original_input'] = trim($order);
            $orderObject['valid'] = false;
            
            $orderAttributes = explode(" ", trim($order));
            if (count($orderAttributes) === 3) {
                $date = $orderAttributes[0];
                $size = $orderAttributes[1];
                $carrier = $orderAttributes[2];
                
                if (Valid::date($date) && Valid::size($size) && Valid::carrier($carrier)){
                    $orderObject['valid'] = true;
                    $orderObject['date'] = $date;
                    $orderObject['size'] = $size;
                    $orderObject['carrier'] = $carrier;
                    $orderObject['price'] = PriceLookup::getPrice($orderObject);
                    $orderObject['discount'] = '0.00';
                }
            }
            $returnArray[] = $orderObject;
        }
        return $returnArray;
    }
}