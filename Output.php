<?php

class Output
{
    public static function echo($order)
    {
        if ($order['valid']){        
            if ($order['discount'] === '0.00') {
                $order['discount'] = '-';
            }
            echo $order['original_input'] . " " . $order['price'] . " " . $order['discount'] . PHP_EOL;
        }
        else {
            echo $order['original_input'] . " " . "Ignored" . PHP_EOL;
        }
    }
}