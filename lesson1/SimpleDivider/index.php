<?php

spl_autoload_register(function ($class) {
	include $class.'.php';
});

ini_set('max_execution_time', 900);

//$simpleDivider = new SimpleDivider(600851475143);
//Мой компьютер не справился даже за 15 минут. php 5.6 Задача явно не для php :)
//$simpleDivider = new SimpleDividerSpl(13195);
$simpleDivider = new SimpleDividerSpl(13195);
echo 'Максимальный простой делитель: ' . $simpleDivider->getMaxDivider() . PHP_EOL;
echo $simpleDivider->getFormula() . PHP_EOL;

