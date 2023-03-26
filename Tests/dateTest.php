<?php

require_once __DIR__ . '/../code/Functions/Month.php';

use \PHPUnit\Framework\TestCase;

class dateTest extends TestCase
{
    public function testSameMonthsTrue()
    {
        $date1 = '2023-01-31';
        $date2 = '2023-01-01';
        $this->assertTrue(Month::same($date1, $date2));
    }

    public function testSameMonthsFalse()
    {
        $date1 = '2023-01-31';
        $date2 = '2023-02-01';
        $this->assertFalse(Month::same($date1, $date2));
    }

    public function testDifferentMonthsTrue()
    {
        $date1 = '2023-01-31';
        $date2 = '2023-02-01';
        $this->assertTrue(Month::different($date1, $date2));
    }

    public function testDifferentMonthsFalse()
    {
        $date1 = '2023-01-31';
        $date2 = '2023-01-01';
        $this->assertFalse(Month::different($date1, $date2));
    }
}
