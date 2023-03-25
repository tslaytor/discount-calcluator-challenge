<?php

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
}
