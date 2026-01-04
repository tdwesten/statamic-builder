<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\DefaultValue;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Color extends Field
{
    use DefaultValue;
    use Makeble;

    protected $type = 'color';

    protected $allow_any = true;

    protected $swatches = [];

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'default' => $this->default,
            'allow_any' => $this->allow_any,
            'swatches' => $this->swatches,
        ]);
    }

    public function allowAny(bool $allow_any)
    {
        $this->allow_any = $allow_any;

        return $this;
    }

    public function swatches(array $swatches)
    {
        $this->swatches = $swatches;

        return $this;
    }
}
