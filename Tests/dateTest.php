<?php

require_once __DIR__ . '/../code/Functions/Month.php';

class dateTest extends \PHPUnit\Framework\TestCase
{
    public function testSameMonths()
    {
        $date1 = '2023-01-31';
        $date2 = '2023-01-01';
        $this->assertTrue(Month::same($date1, $date2));
    }
}
