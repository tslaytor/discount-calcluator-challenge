<?php

require_once 'Models/Order.php';
require_once 'Functions/Month.php';

 /**
     * DESCRIPTION
     * Takes an order and, if the total discount for the month (including this order) exceeds 10
     * it will adjust the price and discount for this order to keep the monthly discount limit to 10
     *
     */

class TotalDiscountLimiter
{
    public static ?string $lastOrderDate = null;
    public static float $totalDiscountThisMonth = 0;
    
    public function __invoke($thisOrder)
    {
        if (Month::same(self::$lastOrderDate, $thisOrder->getDate()))  {
            self::$totalDiscountThisMonth += $thisOrder->getDiscount();
        }
        else {
            // different calendar month
            self::$totalDiscountThisMonth = $thisOrder->getDiscount();
        }
        if (self::$totalDiscountThisMonth > 10){
            $difference = self::$totalDiscountThisMonth - 10;
            self::$totalDiscountThisMonth -= $thisOrder->getDiscount();
            self::$totalDiscountThisMonth += $thisOrder->getDiscount() - $difference;

            $thisOrder->setDiscount(number_format($thisOrder->getDiscount() - $difference, 2));
            $thisOrder->setPrice(number_format($thisOrder->getPrice() + $difference, 2));
        }
        self::$lastOrderDate = $thisOrder->getDate();
    }
}
