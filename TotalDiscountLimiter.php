<?php

class TotalDiscountLimiter
{
    public static ?string $lastOrderMonth = null;
    public static float $totalDiscountThisMonth = 0;
    
    public function __invoke(&$order)
    {
        if (self::$lastOrderMonth === null){
            self::$lastOrderMonth = $order['date'];
        }
        $thisAsDateTime = new DateTime($order['date']);
        $lastAsDateTime = new DateTime(self::$lastOrderMonth);
        
        $interval = $thisAsDateTime->diff($lastAsDateTime);
       
        if (isset($order['discount']) && is_numeric($order['discount'])){
            if ($interval->format('%y%m') === '00') {
                // The two dates are in the same calendar month (and year)
                self::$totalDiscountThisMonth += $order['discount'];
            }
            else {
                self::$totalDiscountThisMonth = $order['discount'];
            }
            if (self::$totalDiscountThisMonth > 10){
                $difference = self::$totalDiscountThisMonth - 10;
                $order['discount'] = number_format($order['discount'] - $difference, 2) ;
                $order['price'] = number_format($order['price'] + $difference, 2);
            }
        }
    }
}
