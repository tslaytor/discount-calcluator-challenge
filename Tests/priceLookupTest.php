<?php

require_once __DIR__ . '/../code/Models/Order.php';
require_once __DIR__ . '/../code/Functions/PriceLookup.php';

use \PHPUnit\Framework\TestCase;

class priceLookupTest extends TestCase
{
    public function testGetPriceSLP(): void
    {
        $order = new Order("test");
        $order->setSize('S');
        $order->setCarrier('LP');

        $this->assertEquals('1.50', PriceLookup::getPrice($order));
    }

    public function testGetPriceMLP(): void
    {
        $order = new Order("test");
        $order->setSize('M');
        $order->setCarrier('LP');

        $this->assertEquals('4.90', PriceLookup::getPrice($order));
    }

    public function testGetPriceLLP(): void
    {
        $order = new Order("test");
        $order->setSize('L');
        $order->setCarrier('LP');

        $this->assertEquals('6.90', PriceLookup::getPrice($order));
    }

    public function testGetPriceSMR(): void
    {
        $order = new Order("test");
        $order->setSize('S');
        $order->setCarrier('MR');

        $this->assertEquals('2.00', PriceLookup::getPrice($order));
    }

    public function testGetPriceMMR(): void
    {
        $order = new Order("test");
        $order->setSize('M');
        $order->setCarrier('MR');

        $this->assertEquals('3.00', PriceLookup::getPrice($order));
    }

    public function testGetPriceLMR(): void
    {
        $order = new Order("test");
        $order->setSize('L');
        $order->setCarrier('MR');

        $this->assertEquals('4.00', PriceLookup::getPrice($order));
    }

    public function testGetCheapestS(): void
    {
        $order = new Order("test");
        $order->setSize('S');

        $this->assertEquals('1.50', PriceLookup::getCheapest($order));
    }

    public function testGetCheapestM(): void
    {
        $order = new Order("test");
        $order->setSize('M');

        $this->assertEquals('3.00', PriceLookup::getCheapest($order));
    }

    public function testGetCheapestL(): void
    {
        $order = new Order("test");
        $order->setSize('L');

        $this->assertEquals('4.00', PriceLookup::getCheapest($order));
    }
}