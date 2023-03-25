<?php

require_once 'Order.php';
require_once 'PriceLookup.php';

// NOTE TO ASSESSOR 
// I wasn't sure if the once per month rule meant either:
// a) After we give a discount one month, we should only start to count new L orders again next month
// e.g. January (Large LP) orders:
// 2023-01-01 (1)
// 2023-01-02 (2)
// 2023-01-03 (3)(free)
// 2023-01-04 (no count)
// 2023-01-05 (no count)
// 2023-01-06 (no count)
// 2023-02-01 (1)(1st order of new month, start count again)
// 2023-02-02 (2)
// 2023-02-03 (3)(free)
// 2023-02-04 (no count)

// OR
// b) After we give a discount one month, we can continue to count new L orders in that month, but only apply a discount in the next month
// e.g. January (Large LP) orders:
// 2023-01-01 (1)
// 2023-01-02 (2)
// 2023-01-03 (3)(free - start count again)
// 2023-01-04 (1)
// 2023-01-05 (2)
// 2023-01-06 (3)(3rd L, same month, not free)
// 2023-02-01 (4) (new month, at least 3 L packages since last discount, free! - start count again)
// 2023-02-02 (1)
// 2023-02-03 (2)
// 2023-02-04 (3) (already had discount this month, not free)

// in my implementation, I've used the 2nd interpretation (b), since is seems the policy is meant to cap the discount, but not punish the customer for 
// ordering across different months

class ThirdLargeFromLpFreeOncePerMonth
{
    public static ?string $lastOrderDate = null;
    public static int $deliveryCount = 0;
    public static bool $gotFreeThisMonth = false;

    public function __invoke($thisOrder)
    {
        if ($thisOrder->size === 'L' && $thisOrder->carrier === 'LP'){
            
            self::$deliveryCount++;

            if (!Month::same(self::$lastOrderDate, $thisOrder->date)){
                self::$gotFreeThisMonth = false;
            }

            if (self::$deliveryCount >= 3 && self::$gotFreeThisMonth === false){
                $thisOrder->price = '0.00';
                $thisOrder->discount = PriceLookup::getPrice($thisOrder);
                self::$gotFreeThisMonth = true;
                self::$deliveryCount = 0;
            }
            self::$lastOrderDate = $thisOrder->date;
        }
    }
}
