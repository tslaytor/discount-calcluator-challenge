<?php

require_once __DIR__ . '/Models/Order.php';
require_once __DIR__ . '/Rules/SmallMatchesLowestPrice.php';
require_once __DIR__ . '/Rules/ThirdLargeFromLpFreeOncePerMonth.php';
require_once __DIR__ . '/Rules/TotalDiscountLimiter.php';
require_once __DIR__ . '/Functions/FileParser.php';
require_once __DIR__ . '/Functions/Output.php';

    /**
     * SUMMARY
     * This is the file that runs all the processes to calculate the discount for each order.
     *
     * DESCRIPTION
     * 1. It parses the file with FileParser::parse() to convert it into a new data structure
     * 2. Then, it lists the rules in the array "rules". Rules are invokable classes. To add a rule or remove a rule, simply add or remove it from the rules array 
     * 3. Next, it loops through each of the orders in the new data structure
     * 4. If an order is valid, it applies each of the rules to the order
     * 5. Finally, it outputs each order to display the results
     * 
     */

$orders = FileParser::parse(__DIR__ . "/input.txt");

$rules = [
    new SmallMatcheslowestPrice(),
    new ThirdLargeFromLpFreeOncePerMonth(),
    new TotalDiscountLimiter()
];

foreach ($orders as $order) {
    if ($order->getValid()){
        foreach ($rules as $rule) {
            $rule($order);
        }
    }
    Output::echo($order);
}