<?php

require_once 'Order.php';
require_once 'PriceLookup.php';

class SmallMatcheslowestPrice
{
    public function __invoke($order)
    {
        if ($order->getSize() === 'S') {
            $originalPrice = $order->getPrice();
            $order->setPrice(PriceLookup::getCheapest($order));
            $order->setDiscount(number_format($originalPrice - $order->getPrice(), 2));
        }
    }
}
