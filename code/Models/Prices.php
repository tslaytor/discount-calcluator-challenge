<?php

   /**
     * SUMMARY
     * An associative array (i.e. dictionary) containing the prices of each size option for each carrier
     *
     * DESCRIPTION
     * This array has been implemented to make updating the prices easier by having a single source for price information that
     * functions can refer to. Therefore you can update prices here without updating the functions that implement the rules, and the rules will still apply
     * 
     * For example, for the rule "All S shipments should always match the lowest S package price among the providers", if the cheapest price among providers
     * changes from 1.50 to 1.60, you can can update the price here and the rule will match the new price of 1.60 without having to update the function for that rule.
     * 
     */

class Prices
{
    public static array $prices = [
        ['carrier' => 'LP', 'size' => 'S', 'price' => '1.50'],
        ['carrier' => 'LP', 'size' => 'M', 'price' => '4.90'],
        ['carrier' => 'LP', 'size' => 'L', 'price' => '6.90'],
        ['carrier' => 'MR', 'size' => 'S', 'price' => '2.00'],
        ['carrier' => 'MR', 'size' => 'M', 'price' => '3.00'],
        ['carrier' => 'MR', 'size' => 'L', 'price' => '4.00']
    ];

}

