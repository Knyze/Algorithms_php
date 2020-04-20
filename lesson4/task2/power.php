<?php

$a = mt_rand(1, 9);
$n = mt_rand(1, 7000);

$masNumber = [$a];
$unit = 0;

for ($i = 2; $i <= $n; $i++) {
    foreach ($masNumber as $key => $value) {
        $calc = $value * $a + $unit;
        $masNumber[$key] = $calc % 1000;
        $unit = floor($calc/1000);
    }
    if ($unit > 0) {
        $masNumber[] = $unit;
        $unit = 0;
    }
}

$strSum = '';

$count = count($masNumber) - 1;
for ($i = 0; $i < $count; $i++) {
    $strSum = str_pad($masNumber[$i], 3, '0', STR_PAD_LEFT) . ' ' . $strSum;
}

$strSum = $masNumber[$count] . ' ' . $strSum;

echo $a . ' в степени ' . $n . ' = ' . $strSum;
