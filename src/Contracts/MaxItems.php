<?php

namespace Tdwesten\StatamicBuilder\Contracts;

trait MaxItems
{
    protected $max_items;

    public function maxItems(int $count)
    {
        $this->max_items = $count;

        return $this;
    }
}
