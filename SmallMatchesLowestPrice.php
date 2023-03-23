<?php

require_once 'Order.php';
require_once 'PriceLookup.php';

class SmallMatcheslowestPrice
{
    public function __invoke($order)
    {
        // if ($order->date === '2015-03-01')
        // {
        //     var_dump($order);
        // }
        if ($order->size === 'S') {
            $originalPrice = $order->price;
            $order->price = PriceLookup::getCheapest($order);
            $order->discount = number_format($originalPrice - $order->price, 2);
            // if ($order->date === '2015-03-01'){
            //     print "DISCOUNT!! " . $order->discount . PHP_EOL;
            // }
        }
    }
}
