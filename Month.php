<?php

class Month
{
    public static function same(&$lastOrderDate, $thisOrderDate): bool
    {
        if ($lastOrderDate === null){
            $lastOrderDate = $thisOrderDate;
        }

        $thisOrderDateTime = new DateTime($thisOrderDate);
        $lastOrderDateTime = new DateTime($lastOrderDate);

        // Month::same(self::$lastOrderMonth, $order->date);

        return $thisOrderDateTime->format('Ym') == $lastOrderDateTime->format('Ym');

        // if ($thisOrderDateTime->format('Ym') == $lastOrderDateTime->format('Ym'))  {
        //     // The two dates are in the same calendar month (and year)
        //     self::$totalDiscountThisMonth += $order->discount;
        // }
    }
}
