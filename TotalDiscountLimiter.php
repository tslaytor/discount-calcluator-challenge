<?php

require_once 'Order.php';
require_once 'Month.php';

class TotalDiscountLimiter
{
    public static ?string $lastOrderDate = null;
    public static float $totalDiscountThisMonth = 0;
    
    public function __invoke($order)
    {
        if (Month::same(self::$lastOrderDate, $order->date))  {
            self::$totalDiscountThisMonth += $order->discount;
        }
        else {
            // different calendar month
            self::$totalDiscountThisMonth = $order->discount;
        }
        if (self::$totalDiscountThisMonth > 10){
            $difference = self::$totalDiscountThisMonth - 10;
            self::$totalDiscountThisMonth -= $order->discount;
            self::$totalDiscountThisMonth += $order->discount - $difference;

            $order->discount = number_format($order->discount - $difference, 2) ;
            $order->price = number_format($order->price + $difference, 2);
        }
        self::$lastOrderDate = $order->date;
    }
}
