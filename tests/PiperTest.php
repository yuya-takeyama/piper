<?php
namespace yuyat;

include __DIR__ . '/../vendor/autoload.php';

use yuyat\Piper;

class PiperTest extends \PHPUnit_Framework_TestCase
{
    public function test_with_closure()
    {
        $mapPlus2 = function ($arr) {
            return \array_map(
                function ($n) {
                    return $n + 2;
                },
                $arr
            );
        };

        $result = Piper::from(\range(1, 3))
            ->pipe($mapPlus2)
            ->get();

        $this->assertSame(array(3, 4, 5), $result);
    }

    public function test_with_function_name_and_an_argument()
    {
        $plus2 = function ($n) {
            return $n + 2;
        };

        $result = Piper::from(range(1, 3))
            ->pipe('array_map', array($plus2))
            ->get();

        $this->assertSame(array(3, 4, 5), $result);
    }

    public function test_with_closure_and_multiple_argumetns()
    {
        $result = Piper::from(3)
            ->pipe(function ($x, $y, $z, $input) { return ($x + $y + $z) * $input; }, [1, 2, 3])
            ->get();

        $this->assertSame(18, $result);
    }

    public function test_with_multiple_pipes()
    {
        $odd = function ($n) {
            return $n % 2 === 1;
        };

        $filterOdd = function ($arr) use ($odd) {
            return array_filter($arr, $odd);
        };

        $plus2 = function ($n) {
            return $n + 2;
        };

        $sumAll = function ($arr) {
            return array_reduce($arr, function ($acc, $x) {
                return $acc + $x;
            }, 0);
        };

        $result = Piper::from(\range(1, 10))
            ->pipe($filterOdd)
            ->pipe('array_map', array($plus2))
            ->pipe($sumAll)
            ->get();

        $this->assertSame(35, $result);
    }
}
