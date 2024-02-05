<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Range extends Field
{
    use Makeble;

    protected $type = 'range';

    protected $min = 0;

    protected $max = 100;

    protected $step = 1;

    protected $prepend = '';

    protected $append = '';

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'min' => $this->min,
            'max' => $this->max,
            'step' => $this->step,
            'prepend' => $this->prepend,
            'append' => $this->append,
        ]);
    }

    public function min(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function max(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function step(int $step): self
    {
        $this->step = $step;

        return $this;
    }

    public function prepend(string $prepend): self
    {
        $this->prepend = $prepend;

        return $this;
    }

    public function append(string $append): self
    {
        $this->append = $append;

        return $this;
    }
}
