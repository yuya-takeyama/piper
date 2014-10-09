<?php
namespace yuyat;

class Piper
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public static function from($value)
    {
        return new static($value);
    }

    public function pipe($fn, $args = array())
    {
        $fullArgs = array_merge($args, array($this->value));

        return new static(call_user_func_array($fn, $fullArgs));
    }

    public function get()
    {
        return $this->value;
    }
}
