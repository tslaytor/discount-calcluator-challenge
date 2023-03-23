<?php

    /**
     * SUMMARY
     * A collection of functions that validate date, size, and carrier for orders
     *
     * DESCRIPTION
     * Each function takes a string and checks if it is in the valid format for that attribute of an order
     * 
     * RETURN VALUE EXAMPLES
     * 
     * date()
     *      input: "2015-02-10"
     *      output: true;
     * 
     *      input: "15-02-10"
     *      output: false;
     * 
     * size()
     *      input: "L"
     *      output: true;
     * 
     *      input: "XL"
     *      output: false;
     * 
     * carrier()
     *       input: "MR"
     *       output: true;
     * 
     *       input: "La Poste"
     *       output: false;
     */

class Valid
{
    public static function date(string $date): bool
    {
        $validDate = false;
        $dateArray = explode("-", $date);
        if (count($dateArray) === 3){
            $validDate = checkdate($dateArray[1], $dateArray[2], $dateArray[0]);
        }
        return $validDate;
    }

    public static function size(string $size): bool
    {
        return $size === 'S' || $size === 'M' || $size === 'L';
    }

    public static function carrier(string $carrier): bool
    {
        return $carrier === 'LP' || $carrier === 'MR';
    }
}
