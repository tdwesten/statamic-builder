<?php

namespace Tdwesten\StatamicBuilder\Contracts;

trait Append
{
    protected $append;

    public function append(string $value)
    {
        $this->append = $value;

        return $this;
    }
}
