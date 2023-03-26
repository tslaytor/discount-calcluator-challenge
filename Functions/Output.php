<?php

require_once 'Models/Order.php';

/**
     * SUMMARY
     * a function that outputs data to the screen (STDOUT) for an order
     *
     * DESCRIPTION
     * If the order is valid, it will output the original input with the price and discount information appended.
     * If the order is not valid, it will output the original input with "Ignored" appended.
     * 
     */

class Output
{
    public static function echo($order)
    {
        if ($order->getValid()){        
            if ($order->getDiscount() === '0.00') {
                $order->setDiscount('-');
            }
            echo $order->getOriginalInput() . " " . $order->getPrice() . " " . $order->getDiscount() . PHP_EOL;
        }
        else {
            echo $order->getOriginalInput() . " " . "Ignored" . PHP_EOL;
        }
    }
}