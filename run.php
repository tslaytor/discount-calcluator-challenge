<?php

require_once 'Order.php';
require_once ("FileParser.php");
require_once ("SmallMatchesLowestPrice.php");
require_once ("ThirdLargeFromLpFreeOncePerMonth.php");
require_once ("TotalDiscountLimiter.php");
require_once ("Output.php");

    /**
     * SUMMARY
     * This is the file that runs all the processes
     *
     * DESCRIPTION
     * 1. It parses the file with FileParser::parse() to convert it into a new data structure
     * 2. Then, it lists the rules in the array "rules". Rules are invokable classes. To add a rule or remove a rule, simply add or remove it from the rules array 
     * 3. Next, it loops through each of the orders in the new data structure
     * 4. If an order is valid, it applies each of the rules to the order
     * 5. Finally, it outputs each order to display the results
     * 
     */

// $orders = FileParser::parse("input.txt");
$orders = FileParser::parse("random-play-tests.txt");

$rules = [
    new SmallMatcheslowestPrice(),
    new ThirdLargeFromLpFreeOncePerMonth(),
    new TotalDiscountLimiter()
];

foreach ($orders as $order) {
    if ($order->valid){
        foreach ($rules as $rule) {
            $rule($order);
        }
    }
    Output::echo($order);
}