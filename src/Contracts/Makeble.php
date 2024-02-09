<?php

namespace Tdwesten\StatamicBuilder\Contracts;

trait Makeble
{
    public static function make($handle, array $fields = []): static
    {
        return new static($handle, $fields);
    }
}
