<?php

require_once __DIR__ . '/../Models/Order.php';
require_once __DIR__ . '/PriceLookup.php';
require_once __DIR__ . '/Valid.php';

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
     * EXAMPLES
     * 
     * 1.
     * valid input example
     * input: "2015-02-10 S MR"
     * output: 
     *    Order {
     *          'original_input' => '2015-02-10 S MR',
     *          'valid' => 'true',
     *          'date' => '2015-02-10',
     *          'size' => 'S',
     *          'carrier' => 'MR',
     *          'price' => '2',
     *          'discount' => '0.00' // standard discount before any discount rules are applied
     *          }
     * 
     * 2.
     * invalid input example
     * input: "2015-55-10 SM MR"
     * output: 
     *    Order {
     *          'original_input' => '2015-55-10 SM MR',
     *          'valid' => 'false',
     *          'date' => null,
     *          'size' => null,
     *          'carrier' => null,
     *          'price' => null,
     *          'discount' => '0.00'
     *          }
     */

    public static function parse($file)
    {
        $returnArray = [];
        $orders = file($file);
        foreach ($orders as $order) {
            $orderObject = new Order(trim($order));
            
            $orderAttributes = explode(" ", trim($order));
            if (count($orderAttributes) === 3) {
                $date = $orderAttributes[0];
                $size = $orderAttributes[1];
                $carrier = $orderAttributes[2];
                
                if (Valid::date($date) && Valid::size($size) && Valid::carrier($carrier)){
                    $orderObject->setValid(true);
                    $orderObject->setDate($date);
                    $orderObject->setSize($size);
                    $orderObject->setCarrier($carrier);
                    $orderObject->setPrice(PriceLookup::getPrice($orderObject));
                }
            }
            $returnArray[] = $orderObject;
        }
        return $returnArray;
    }
}