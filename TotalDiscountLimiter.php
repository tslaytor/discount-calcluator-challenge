<?php

require_once 'Order.php';
require_once 'Month.php';

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
