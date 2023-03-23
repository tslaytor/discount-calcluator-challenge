<?php

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
     * RETURN VALUE EXAMPLES
     * 
     */

class PriceLookup
{
    public static function getPrice($order): string
    {
        $match = array_filter(Prices::$prices, function ($input) use ($order) {
            return $input['carrier'] === $order['carrier'] && $input['size'] === $order['size'];
        });
        return reset($match)['price'];
    }

    public static function getCheapest($order): string
    {
        $sizeMatch = array_filter(Prices::$prices, function ($input) use ($order) {
            return $input['size'] === $order['size'];
        });
        return min(array_column($sizeMatch, 'price'));
    }
}