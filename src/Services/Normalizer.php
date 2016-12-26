<?php

namespace Yab\Quarx\Services;

class Normalizer
{
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }

    public function plain()
    {
        return strip_tags($this->value);
    }
}
