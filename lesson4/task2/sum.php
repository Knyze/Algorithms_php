<?php

$file = fopen("chisla.txt", 'r+') or die("не удалось открыть файл");

$strNumber1 = htmlentities(fgets($file));
$strNumber2 = htmlentities(fgets($file));

$strNumber1 = strrev(trim($strNumber1));
$strNumber2 = strrev(trim($strNumber2));

$masNumber1 = str_split($strNumber1);
$masNumber2 = str_split($strNumber2);

$length = max(count($masNumber1), count($masNumber2));
$unit = 0;

for ($i = 0; $i < $length; $i++) {
    
    $sum = +$masNumber1[$i] + +$masNumber2[$i] + +$unit;
    $masSum[$i] = $sum % 10;
    $unit = ($sum > 9);
}

$strSum = strrev(implode($masSum));

fwrite($file, PHP_EOL . $strSum);
fclose($file);
