<?php

require_once ("FileParser.php");
require_once ("SmallMatchesLowestPrice.php");
require_once ("ThirdLargeFromLpFreeOncePerMonth.php");
require_once ("TotalDiscountLimiter.php");
require_once ("Output.php");

$data = FileParser::read("input.txt");

$rules = [
    new SmallMatcheslowestPrice(),
    new ThirdLargeFromLpFreeOncePerMonth(),
    new TotalDiscountLimiter()
];

foreach ($data as &$order) {
    if ($order['ignore'] === false){
        foreach ($rules as $rule) {
            $rule($order);
        }
    }
    Output::echo($order);
}