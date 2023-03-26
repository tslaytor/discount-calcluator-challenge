<?php

require_once __DIR__ . '/../code/Models/Order.php';

use \PHPUnit\Framework\TestCase;

class orderTest extends TestCase
{
    public function testBlankOriginal(): void
    {
        $order = new Order("test");
        $this->assertEquals("test", $order->getOriginalInput());
    }

    public function testBlankValid(): void
    {
        $order = new Order("test");
        $this->assertFalse($order->getValid());
    }

    public function testBlankDate(): void
    {
        $order = new Order("test");
        $this->assertEquals(null, $order->getDate());
    }

    public function testBlankSize(): void
    {
        $order = new Order("test");
        $this->assertEquals(null, $order->getSize());
    }

    public function testBlankCarrier(): void
    {
        $order = new Order("test");
        $this->assertEquals(null, $order->getCarrier());
    }

    public function testBlankPrice(): void
    {
        $order = new Order("test");
        $this->assertEquals(null, $order->getPrice());
    }

    public function testBlankDiscount(): void
    {
        $order = new Order("test");
        $this->assertEquals('0.00', $order->getDiscount());
    }

    public function testSetGetValid(): void
    {
        $order = new Order("test");
        $order->setValid(true);
        $this->asserttrue($order->getValid());
    }
    
    public function testSetGetDate(): void
    {
        $order = new Order("test");
        $order->setDate('2022-01-01');
        $this->assertEquals('2022-01-01', $order->getDate());
    }

    public function testSetGetSize(): void
    {
        $order = new Order("test");
        $order->setSize('S');
        $this->assertEquals('S', $order->getSize());
    }

    public function testSetGetCarrier(): void
    {
        $order = new Order("test");
        $order->setCarrier('LP');
        $this->assertEquals('LP', $order->getCarrier());
    }

    public function testSetGetPrice(): void
    {
        $order = new Order("test");
        $order->setPrice('6.90');
        $this->assertEquals('6.90', $order->getPrice());
    }

    public function testSetGetDiscount(): void
    {
        $order = new Order("test");
        $order->setDiscount('2.10');
        $this->assertEquals('2.10', $order->getDiscount());
    }
}