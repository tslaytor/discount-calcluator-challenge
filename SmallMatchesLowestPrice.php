<?php

class SmallMatcheslowestPrice
{
    public function __invoke(&$order)
    {
        if ($order['size'] === 'S' && $order['carrier'] === 'MR') {
            $order['price'] = '1.50';
            $order['discount'] = '0.50';
        }
    }
}
