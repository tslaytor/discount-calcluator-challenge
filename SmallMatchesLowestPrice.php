<?php

require_once 'PriceLookup.php';

class SmallMatcheslowestPrice
{
    public function __invoke(&$order)
    {
        if ($order['size'] === 'S') {
            $originalPrice = $order['price'];
            $order['price'] = PriceLookup::getCheapest($order);
            $order['discount'] = number_format($originalPrice - $order['price'], 2);
        }
    }
}
