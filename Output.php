<?php

class Output
{
    public static function echo($order)
    {
        if ($order['ignore']){
            echo $order['unchanged'] . " " . "Ignored" . PHP_EOL;
        }
        else {
            echo $order['date'] . " " . $order['size'] . " " . $order['carrier'] . " " . $order['price'] . " " . $order['discount'] . PHP_EOL;
        }
    }
}