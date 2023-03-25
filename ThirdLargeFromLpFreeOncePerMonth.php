<?php

require_once 'Order.php';
require_once 'PriceLookup.php';

class ThirdLargeFromLpFreeOncePerMonth
{
    public static ?string $lastOrderDate = null;
    public static int $deliveryCount = 0;
    public static bool $gotFreeThisMonth = false;

    public function __invoke($order)
    {
        if ($order->size === 'L' && $order->carrier === 'LP'){
            if (Month::same(self::$lastOrderDate, $order->date)) {
                // The two dates are in the same calendar month (and year)
                self::$deliveryCount++;
                if (self::$deliveryCount === 3) {
                    // This one is free
                    $order->price = '0.00';
                    $order->discount = PriceLookup::getPrice($order);

                    $gotFreeThisMonth = true;
                }
            }
            else {
                self::$deliveryCount++;

                $gotFreeThisMonth = false;
                // different month, so set the counter to 1 (this is the first large delivery of the month)
                if (self::$deliveryCount === 3) {
                    // This one is free - dont reset the counter
                    $order->price = '0.00';
                    $order->discount = PriceLookup::getPrice($order);
                    $gotFreeThisMonth = true;
                }
                else if (self::$deliveryCount > 3) {
                    self::$deliveryCount = 1;
                }
                
                // update the last order month
                self::$lastOrderDate = $order->date;
            }       
        }
    }
}
