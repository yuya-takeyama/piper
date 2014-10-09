<?php
include __DIR__ . '/vendor/autoload.php';

use yuyat\Piper;

use function iter\fn\operator;
use function iter\range;
use function iter\map;
use function iter\reduce;

class IterPiper extends Piper
{
    public function map($fn)
    {
        return new static(map($fn, $this->get()));
    }

    public function reduce($fn, $initial = null)
    {
        return new static(reduce($fn, $this->get(), $initial));
    }
}

$result = IterPiper::from(range(1, 10))
    ->map(operator('*', 2))
    ->reduce(operator('+'), 0)
    ->get();

echo $result, PHP_EOL;
