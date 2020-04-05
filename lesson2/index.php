<?php

function fillMas(&$mas, $beginX, $endX, $beginY, $endY, $direct, $number) {
    
    if (($beginX > $endX) || ($beginY > $endY)) {
        return;
    }
        
    
    switch ($direct) {
        
        case 'right':
            for ($i = $beginX; $i <= $endX; $i++) {
                $mas[$beginY][$i] = $number;
                $number++;
            }
            fillMas($mas, $beginX, $endX, $beginY + 1, $endY, 'down', $number);
            break;
                
        case 'down':
            for ($i = $beginY; $i <= $endY; $i++) {
                $mas[$i][$endX] = $number;
                $number++;
            }
            fillMas($mas, $beginX, $endX - 1, $beginY, $endY, 'left', $number);
            break;
            
        case 'left':
            for ($i = $endX; $i >= $beginX; $i--) {
                $mas[$endY][$i] = $number;
                $number++;
            }
            fillMas($mas, $beginX, $endX, $beginY, $endY - 1, 'up', $number);
            break;
            
        case 'up':
            for ($i = $endY; $i >= $beginY; $i--) {
                $mas[$i][$beginX] = $number;
                $number++;
            }
            fillMas($mas, $beginX + 1, $endX, $beginY, $endY, 'right', $number);
            break;
    }
}

function filledMas($width, $heiqht) {
    if (!($width > 0) || !($heiqht > 0)) {
        echo 'Неправильные данные!';
        return [];
    }

    for ($i = 1; $i <= $heiqht; $i++)
        for ($j = 1; $j <= $width; $j++)
            $mas[$i][$j] = 1;
    
    fillMas($mas, 1, $width, 1, $heiqht, 'right', 1);
    
    return $mas;
}

$mas = filledMas(4,4);

foreach ($mas as $value) {
    echo implode(' ', $value) . '<br>';
}