<?php

require_once 'Order.php';
require_once 'Month.php';

class TotalDiscountLimiter
{
    public static ?string $lastOrderDate = null;
    public static float $totalDiscountThisMonth = 0;
    
    public function __invoke($thisOrder)
    {
        if (Month::same(self::$lastOrderDate, $thisOrder->date))  {
            self::$totalDiscountThisMonth += $thisOrder->discount;
        }
        else {
            // different calendar month
            self::$totalDiscountThisMonth = $thisOrder->discount;
        }
        if (self::$totalDiscountThisMonth > 10){
            $difference = self::$totalDiscountThisMonth - 10;
            self::$totalDiscountThisMonth -= $thisOrder->discount;
            self::$totalDiscountThisMonth += $thisOrder->discount - $difference;

            $thisOrder->discount = number_format($thisOrder->discount - $difference, 2) ;
            $thisOrder->price = number_format($thisOrder->price + $difference, 2);
        }
        self::$lastOrderDate = $thisOrder->date;
    }
}
