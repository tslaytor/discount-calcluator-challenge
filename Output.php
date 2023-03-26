<?php

require_once 'Order.php';

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