<?php

require_once __DIR__ . '/../code/Functions/Output.php';
require_once __DIR__ . '/../code/Functions/FileParser.php';

use \PHPUnit\Framework\TestCase;

class outputTest extends TestCase
{
    public function testValidOutput(): void
    {
        $orders = FileParser::parse(__DIR__ . '/fileParserTestFiles/testSMR.txt');
        $order = reset($orders);

        $this->expectOutputString('2022-05-06 S MR 2.00 -' . PHP_EOL);

        Output::echo($order); 
    }

    public function testInvalidOutput(): void
    {
        $orders = FileParser::parse(__DIR__ . '/fileParserTestFiles/testInvalid.txt');
        $order = reset($orders);

        $this->expectOutputString('2023-11-16 LP L Ignored' . PHP_EOL);

        Output::echo($order); 
    }
}