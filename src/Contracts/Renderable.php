<?php

namespace Tdwesten\StatamicBuilder\Contracts;

use Illuminate\Support\Collection;

interface Renderable
{
    public function fieldToArray(): Collection;
}
