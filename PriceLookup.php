<?php

require_once 'Prices.php';

class PriceLookup
{
    public static function getPrice($order)
    {
        $match = array_filter(Prices::$prices, function ($input) use ($order) {
            return $input['carrier'] === $order['carrier'] && $input['size'] === $order['size'];
        });
        return reset($match)['price'];
    }

    public static function getCheapest($order)
    {
        $sizeMatch = array_filter(Prices::$prices, function ($input) use ($order) {
            return $input['size'] === $order['size'];
        });
        return min(array_column($sizeMatch, 'price'));
    }
}