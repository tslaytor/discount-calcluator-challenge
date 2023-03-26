<?php

require_once __DIR__ . '/../code/Models/Order.php';
require_once __DIR__ . '/../code/Functions/FileParser.php';

use \PHPUnit\Framework\TestCase;

class fileParserTest extends TestCase
{
    public function testCorrectDateSet()
    {
        $orders = FileParser::parse(__DIR__ . '/fileParserTestFiles/testSMR.txt');
        $order = reset($orders);

        $this->assertEquals('2022-05-06', $order->getDate());
    }

    public function testCorrectCarrierMRSet()
    {
        $orders = FileParser::parse(__DIR__ . '/fileParserTestFiles/testSMR.txt');
        $order = reset($orders);

        $this->assertEquals('MR', $order->getCarrier());
    }

    public function testCorrectCarrierLPSet()
    {
        $orders = FileParser::parse(__DIR__ . '/fileParserTestFiles/testMLP.txt');
        $order = reset($orders);
        
        $this->assertEquals('LP', $order->getCarrier());
    }

    public function testCorrectSizeSmallSet()
    {
        $orders = FileParser::parse(__DIR__ . '/fileParserTestFiles/testSMR.txt');
        $order = reset($orders);

        $this->assertEquals('S', $order->getSize());
    }

    public function testCorrectSizeMediumSet()
    {
        $orders = FileParser::parse(__DIR__ . '/fileParserTestFiles/testMLP.txt');
        $order = reset($orders);

        $this->assertEquals('M', $order->getSize());
    }

    public function testCorrectSizeLargeSet()
    {
        $orders = FileParser::parse(__DIR__ . '/fileParserTestFiles/testLLP.txt');
        $order = reset($orders);

        $this->assertEquals('L', $order->getSize());
    }

    public function testOriginalInput()
    {
        $orders = FileParser::parse(__DIR__ . '/fileParserTestFiles/testLLP.txt');
        $order = reset($orders);

        $this->assertEquals('2023-11-16 L LP', $order->getOriginalInput());
    }

    public function testValid()
    {
        $orders = FileParser::parse(__DIR__ . '/fileParserTestFiles/testLLP.txt');
        $order = reset($orders);

        $this->assertEquals(true, $order->getValid());
    }

    public function testInvalid()
    {
        $orders = FileParser::parse(__DIR__ . '/fileParserTestFiles/testInvalid.txt');
        $order = reset($orders);

        $this->assertEquals(false, $order->getValid());
    }

    public function testArray()
    {
        $orders = FileParser::parse(__DIR__ . '/fileParserTestFiles/testLLP.txt');

        $this->assertIsArray($orders);
    }
}
