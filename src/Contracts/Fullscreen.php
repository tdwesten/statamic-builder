<?php

namespace Tdwesten\StatamicBuilder\Contracts;

trait Fullscreen
{
    protected $fullscreen = false;

    public function fullscreen(bool $fullscreen = true): self
    {
        $this->fullscreen = $fullscreen;

        return $this;
    }
}
