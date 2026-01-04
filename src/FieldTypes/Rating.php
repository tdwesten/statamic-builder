<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\DefaultValue;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Rating extends Field
{
    use DefaultValue;
    use Makeble;

    protected $type = 'rating';

    protected $min;

    protected $max;

    protected $step;

    protected $clearable;

    protected $color;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'default' => $this->default,
            'min' => $this->min,
            'max' => $this->max,
            'step' => $this->step,
            'clearable' => $this->clearable,
            'color' => $this->color,
        ]);
    }

    public function min(int $min)
    {
        $this->min = $min;

        return $this;
    }

    public function max(int $max)
    {
        $this->max = $max;

        return $this;
    }

    public function step(int|float $step)
    {
        $this->step = $step;

        return $this;
    }

    public function clearable(bool $clearable = true)
    {
        $this->clearable = $clearable;

        return $this;
    }

    public function color(string $color)
    {
        $this->color = $color;

        return $this;
    }
}
