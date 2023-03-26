<?php

// require_once __DIR__ . '/../code/Models/Order.php';
require_once __DIR__ . '/../code/Functions/Valid.php';

use \PHPUnit\Framework\TestCase;

class validTest extends TestCase
{
    public function testValidDate(): void
    {
        $this->assertTrue(Valid::date('2023-08-12'));
    }

    public function testInvalidDate(): void
    {
        $this->assertFalse(Valid::date('12-08-2023'));
    }

    public function testValidSizeS(): void
    {
        $this->assertTrue(Valid::size('S'));
    }

    public function testValidSizeM(): void
    {
        $this->assertTrue(Valid::size('M'));
    }

    public function testValidSizeL(): void
    {
        $this->assertTrue(Valid::size('L'));
    }

    public function testInvalidSize(): void
    {
        $this->assertFalse(Valid::size('s'));
    }

    public function testInvalidSizeWord(): void
    {
        $this->assertFalse(Valid::size('Medium'));
    }

    public function testValidCarrierLP(): void
    {
        $this->assertTrue(Valid::Carrier('LP'));
    }

    public function testValidCarrierMR(): void
    {
        $this->assertTrue(Valid::Carrier('MR'));
    }

    public function testInvalidCarrier(): void
    {
        $this->assertFalse(Valid::Carrier('lp'));
    }
}