<?php

namespace Tdwesten\StatamicBuilder\Contracts;

trait Prepend
{
    protected $prepend;

    public function prepend(string $value)
    {
        $this->prepend = $value;

        return $this;
    }
}
