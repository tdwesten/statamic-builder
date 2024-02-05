<?php

namespace Tdwesten\StatamicBuilder\Contracts;

trait MaxItems
{
    protected $maxItems;

    public function maxItems(int $count)
    {
        $this->maxItems = $count;

        return $this;
    }
}
