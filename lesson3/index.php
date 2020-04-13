<?php

$mas = [1, 2 ,3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16];
//$mas = [1, 2, 4, 5, 6];
//$mas = [];

function missedNumber($mas) {
    
    $start = 0;
    $end = count($mas) - 1;
    
    while ($start <= $end) {
        $middle = (int) floor(($start + $end) / 2);
        if ( $mas[$middle] === ($middle + 1) ) {
            $start = $middle + 1;
        } else {
            $end = $middle - 1;
        }
    }
    
    return $start + 1;
}

echo missedNumber($mas);