<?php

require_once 'Prices.php';

class PriceLookup
{
    public static function getPrice($order)
    {
        $match = array_filter(Prices::$prices, function ($input) use ($order) {
            if (isset($order['carrier'])&& isset($order['size'])){
                return $input['carrier'] === $order['carrier'] && $input['size'] === $order['size'];
            }
            else {
                return false;
            }
        });
        $match = reset($match);
        if (isset($match['price'])){
            return $match['price'];
        }
        else {
            return null;
        }
    }
}