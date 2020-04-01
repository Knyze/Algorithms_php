<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php

spl_autoload_register(function ($class) {
	include $class.'.php';
});

/*<a href=""><?= mb_convert_encoding($item, 'UTF-8', 'windows-1251') ?></a><br>*/

$path = htmlspecialchars($_GET["dir"]);
if ( $path === '' ) {
    $path = '/';// . mb_convert_encoding('СУБД', 'windows-1251', 'UTF-8');
    $basePath = true;
}
$dir = new DirectoryIterator($path);
//$dir = new DirList($path);
//$dir1 = $dir->getIterator();

/*
while($dir1->valid()) {
    echo $dir1->current()->getFilename() . "\n";
    $dir1->next();
}
*/

//$dir->asort();
foreach ($dir as $item): ?>
    <?php if ($basePath): ?>
    <a href="?dir=<?= '/' . $item->getFilename() ?>"><?= $item ?></a><br>
    <?php else: ?>
    <a href="?dir=<?= $item->getPathname() ?>"><?= $item ?></a><br>
    <?php endif ?>
<?php endforeach ?>
