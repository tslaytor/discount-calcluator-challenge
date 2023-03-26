<?php

require_once __DIR__ . '/../code/Models/Order.php';
// require_once __DIR__ . '/../code/Functions/PriceLookup.php';
require_once __DIR__ . '/../code/Rules/SmallMatchesLowestPrice.php';

use \PHPUnit\Framework\TestCase;

class SmallMatchesLowestPriceTest extends TestCase
{
    public function testSmallMatchesLowestPriceMR(): void
    {
        $order = new Order('test');
        $order->setDate('2022-05-06');
        $order->setSize('S');
        $order->setCarrier('MR');
        $order->setPrice('2.00');

        $rule = new SmallMatchesLowestPrice();
        $rule($order);

        $this->expectOutputString('1.50 0.50' . PHP_EOL);

        echo $order->getPrice() . " " . $order->getDiscount() . PHP_EOL;
    }

    public function testSmallMatchesLowestPriceLP(): void
    {
        $order = new Order('test');
        $order->setDate('2022-05-06');
        $order->setSize('S');
        $order->setCarrier('LP');
        $order->setPrice('1.50');

        $rule = new SmallMatchesLowestPrice();
        $rule($order);

        $this->expectOutputString('1.50 0.00' . PHP_EOL);

        echo $order->getPrice() . " " . $order->getDiscount() . PHP_EOL;
    }
}