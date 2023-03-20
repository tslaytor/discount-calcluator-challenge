<?php

class ThirdLargeFromLpFreeOncePerMonth
{
    public static ?string $lastOrderMonth = null;
    public static int $deliveriesThisMonth = 0;

    public function __invoke(&$order)
    {
        if ($order['size'] === 'L' && $order['carrier'] === 'LP'){
            if (self::$lastOrderMonth === null){
                self::$lastOrderMonth = $order['date'];
            }
            $thisAsDateTime = new DateTime($order['date']);
            $lastAsDateTime = new DateTime(self::$lastOrderMonth);
            
            $interval = $thisAsDateTime->diff($lastAsDateTime);
            
            if ($interval->format('%y%m') === '00') {
                // The two dates are in the same calendar month (and year)
                self::$deliveriesThisMonth++;
                if (self::$deliveriesThisMonth === 3) {
                    // This one is free
                    $order['price'] = '0';
                    $order['discount'] = '6.90';
                }
            }
            else {
                // different month, so set the counter to 1 (this is the first large delivery of the month)
                self::$deliveriesThisMonth = 1;
                // update the last order month
                self::$lastOrderMonth = $order['date'];
            }       
        }
    }
}
