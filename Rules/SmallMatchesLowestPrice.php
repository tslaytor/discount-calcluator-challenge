<?php

require_once 'Models/Order.php';
require_once 'Functions/PriceLookup.php';

 /**
     * DESCRIPTION
     * Takes an order and, if the order size is small: 
     * 1. Sets the price to the lowest for small orders among carriers
     * 2. Sets the discount that has been applied to that order
     *
     */

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
