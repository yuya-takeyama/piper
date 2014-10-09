<?php
include __DIR__ . '/vendor/autoload.php';

use yuyat\Piper;

use function iter\fn\operator;
use function iter\range;

$result = Piper::from(range(1, 10))
    ->pipe('iter\map', [operator('*', 2)])
    ->pipe('iter\reduce', [operator('+')])
    ->get();

echo $result, PHP_EOL;
