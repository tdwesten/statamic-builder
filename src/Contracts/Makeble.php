<?php

namespace Tdwesten\StatamicBuilder\Contracts;

trait Makeble
{
    public static function make($handle, array $fields = []): self
    {
        return new static($handle);
    }
}
