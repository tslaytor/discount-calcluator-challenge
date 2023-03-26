<?php

require_once __DIR__ . '/../code/Models/Order.php';
require_once __DIR__ . '/../code/Rules/TotalDiscountLimiter.php';

use \PHPUnit\Framework\TestCase;

class discountLimitTest extends TestCase
{

    protected function setUp(): void
    {
        TotalDiscountLimiter::$totalDiscountThisMonth = 9;
        TotalDiscountLimiter::$lastOrderDate = '2023-01-01';
    }

    public function testDiscountLimit(): void
    {
        $order = new Order('2023-01-02 L LP');
        $order->setDate('2023-01-02');
        $order->setDiscount('6.90');
        $rule = new TotalDiscountLimiter();
        $rule($order);
        $this->assertEquals('5.90', $order->getPrice());
    }
}