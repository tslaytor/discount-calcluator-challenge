<?php

require_once __DIR__ . '/../code/Models/Order.php';
require_once __DIR__ . '/../code/Rules/ThirdLargeFromLpFreeOncePerMonth.php';

use \PHPUnit\Framework\TestCase;

class thirdLargeFreeTest extends TestCase
{

    protected function setUp(): void
    {
        ThirdLargeFromLpFreeOncePerMonth::$deliveryCount = 2;
    }

    public function testThirdLargeFree(): void
    {
        $order = new Order('test');
        $order->setSize('L');
        $order->setCarrier('LP');
        $order->setDate('2022-05-05');
        $rule = new ThirdLargeFromLpFreeOncePerMonth();
        $rule($order);

        $this->assertEquals('0.00', $order->getPrice());
    }
}