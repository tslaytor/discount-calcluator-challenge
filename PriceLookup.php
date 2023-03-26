<?php

require_once 'Order.php';
require_once 'Prices.php';

    /**
     * SUMMARY
     * A collection of functions that look up prices
     *
     * DESCRIPTION
     * getPrice() - takes an object, and uses it's size and carrier properties to loop up the price
     * getCheapest() - takes an object and finds the cheapest price for that size, regardless of carrier
     * 
     * both functions assume valid input. Therefore, input object must be validated first with FileParser::parse() 
     * 
     * EXAMPLES
     * $order = new Order(...); // an order object with 'carrier' = 'LP' and size = 'L';
     * getPrice($order) // returns '6.90';
     * 
     * $order = new Order(...); // an order object with 'size' = 'S';
     * getCheapest($order) // returns '1.50';
     * 
     */

class PriceLookup
{
    public static function getPrice($order): string
    {
        $match = array_filter(Prices::$prices, function ($prices) use ($order) {
            return $prices['carrier'] === $order->getCarrier() && $prices['size'] === $order->getSize();
        });
        return reset($match)['price'];
    }

    public static function getCheapest($order): string
    {
        $sizeMatch = array_filter(Prices::$prices, function ($prices) use ($order) {
            return $prices['size'] === $order->getSize();
        });
        return min(array_column($sizeMatch, 'price'));
    }
}