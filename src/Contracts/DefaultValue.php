<?php

namespace Tdwesten\StatamicBuilder\Contracts;

trait DefaultValue
{
    protected $default;

    public function default($value)
    {
        $this->default = $value;

        return $this;
    }

    public function defaultValue($value)
    {
        $this->default($value);
    }
}
