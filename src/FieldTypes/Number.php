<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Append;
use Tdwesten\StatamicBuilder\Contracts\DefaultValue;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Contracts\Prepend;

class Number extends Field
{
    use Append;
    use DefaultValue;
    use Makeble;
    use Prepend;

    protected $type = 'number';

    protected $min;

    protected $max;

    protected $step;

    protected $placeholder;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'default' => $this->default,
            'prepend' => $this->prepend,
            'append' => $this->append,
            'min' => $this->min,
            'max' => $this->max,
            'step' => $this->step,
            'placeholder' => $this->placeholder,
        ]);
    }

    public function min(int|float $min)
    {
        $this->min = $min;

        return $this;
    }

    public function max(int|float $max)
    {
        $this->max = $max;

        return $this;
    }

    public function step(int|float $step)
    {
        $this->step = $step;

        return $this;
    }

    public function placeholder(string $placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }
}
