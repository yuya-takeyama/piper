# yuyat\Piper

Helps functional programming in OO style.

It is recommended to combine this library with other functional libraries like [iter](https://github.com/nikic/iter).

## Usage

### Basic Piper

```php
<?php
use yuyat\Piper;

use function iter\fn\operator;
use function iter\range;

$result = Piper::from(range(1, 10));
    ->pipe('iter\map', [operator('*', 2)])
    ->pipe('iter\reduce', [operator('+')])
    ->get();

echo $result, PHP_EOL;
// => 110
```

### Your custom Piper

```php
<?php
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

    public function reduce($fn, $initial)
    {
        return new static(reduce($fn, $initial, $this->get()));
    }
}

$result = IterPiper::from(range(1, 10))
    ->map(operator('*', 2))
    ->reduce(operator('+'), 0)
    ->get();

echo $result, PHP_EOL;
// => 110
```

## Author

Yuya Takeyama
