<?php

/**
     * SUMMARY
     * functions that determine if the 2 dates given as arguments are in the same or different calendar months
     *
     * DESCRIPTION
     * The same() functions take the last order date and this order deate and compares them to see if they are in the same calendar month
     * It returns true is the 2 dates are in the same calendar month, and false otherwise
     * the last order date is passed by reference, incase the value is null and therefore the static variable needs to be updated in the parent class
     * 
     * The different() function calls the same() function are reverses the values e.g. if same() returns true, different() returns false
     * different() has been implemented for the sake for easier readabilty when used in the code
     * 
     * EXAMPLES
     * same('2022-03-11', '2022-03-22'): true
     * same('2022-03-11', '2022-04-13'): false
     * same('2022-03-11', '2023-03-11): false
     * 
     * different('2022-03-11', '2022-03-22'): false
     * different('2022-03-11', '2022-04-13'): true
     * different('2022-03-11', '2023-03-11): true
     */

class Month
{
    public static function same(&$lastOrderDate, $thisOrderDate): bool
    {
        if ($lastOrderDate === null){
            $lastOrderDate = $thisOrderDate;
        }

        $thisOrderDateTime = new DateTime($thisOrderDate);
        $lastOrderDateTime = new DateTime($lastOrderDate);

        return $thisOrderDateTime->format('Ym') == $lastOrderDateTime->format('Ym');
    }

    public static function different(&$lastOrderDate, $thisOrderDate): bool
    {
        return !self::same($lastOrderDate, $thisOrderDate);
    }
}