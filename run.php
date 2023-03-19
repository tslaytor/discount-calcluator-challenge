<?php

require_once ("FileParser.php");
require_once ("SmallMatchesLowestPrice.php");
require_once ("ThirdLargeFromLpFreeOncePerMonth.php");
require_once ("TotalDiscountLimiter.php");

$data = FileParser::read("input.txt");

$rules = [
    new SmallMatcheslowestPrice(),
    new ThirdLargeFromLpFreeOncePerMonth(), 
    new TotalDiscountLimiter()
];

foreach ($data as $key => &$order) {
    foreach ($rules as $key => $rule) {
        $rule($order);
    }
    if (!isset($order['ignore'])){
        echo $order['date'] . " " . $order['size'] . " "  . $order['carrier'] . " " . number_format($order['price'], 2) . " " . $order['discount'] . PHP_EOL;
    }
    else {
        if (isset($order['date'])){
            echo $order['date'] . " ";
        }
        if (isset($order['size'])){
            echo $order['size'] . " ";
        }
        if (isset($order['carrier'])){
            echo $order['carrier'] . " ";
        }
        echo "Ignored"  . PHP_EOL;
    }
    
}