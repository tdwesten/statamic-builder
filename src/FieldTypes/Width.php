<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Width extends Field
{
    use Makeble;

    protected $type = 'width';

    protected $options = [25, 33, 50, 66, 75, 100];

    protected $default = 100;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'options' => $this->options,
            'default' => $this->default,
        ]);
    }

    public function options(array $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function default($default): self
    {
        $this->default = $default;

        return $this;
    }
}
