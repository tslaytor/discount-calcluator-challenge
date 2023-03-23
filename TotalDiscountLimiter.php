<?php

require_once 'Order.php';

class TotalDiscountLimiter
{
    public static ?string $lastOrderMonth = null;
    public static float $totalDiscountThisMonth = 0;
    
    public function __invoke($order)
    {
        if ($order->date === '2016-03-09' || $order->date === '2017-03-15'){
            print "total this month: " . self::$totalDiscountThisMonth . PHP_EOL;
        }
        if (self::$lastOrderMonth === null){
            self::$lastOrderMonth = $order->date;
        }

        $thisOrderDateTime = new DateTime($order->date);
        $lastOrderDateTime = new DateTime(self::$lastOrderMonth);

        $interval = $thisOrderDateTime->diff($lastOrderDateTime);

        if ($interval->format('%y%m') === '00') {
            // The two dates are in the same calendar month (and year)
            self::$totalDiscountThisMonth += $order->discount;
        }
        else {
            print "MONTH CHANGE" .PHP_EOL;
            self::$totalDiscountThisMonth = $order->discount;
        }
        if (self::$totalDiscountThisMonth > 10){
            $difference = self::$totalDiscountThisMonth - 10;
            self::$totalDiscountThisMonth -= $order->discount;
            self::$totalDiscountThisMonth += $order->discount - $difference;

            $order->discount = number_format($order->discount - $difference, 2) ;
            $order->price = number_format($order->price + $difference, 2);
        }
        self::$lastOrderMonth = $order->date;
    }
}
