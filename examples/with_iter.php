<?php
include __DIR__ . '/vendor/autoload.php';

use yuyat\Piper;

use function iter\fn\operator;
use function iter\range;
use function iter\reduce;

$result = Piper::from(range(1, 10))
    ->pipe('iter\map', [operator('*', 2)])
    ->pipe(function ($iter) { return reduce(operator('+'), $iter, 0); })
    ->get();

echo $result, PHP_EOL;
