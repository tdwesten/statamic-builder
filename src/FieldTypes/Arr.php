<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Enums\ArrayModeOption;

class Arr extends Field
{
    use Makeble;

    protected $type = 'array';

    protected $mode;

    protected $keys;

    public function __construct($handle)
    {
        parent::__construct($handle, $this->type);

        $this->icon = 'array';

        $this->mode = ArrayModeOption::Dynamic;
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'mode' => $this->mode->value,
            'keys' => $this->keys,
        ]);
    }

    public function mode(ArrayModeOption $mode)
    {
        $this->mode = $mode;

        return $this;
    }

    public function keys(array $keys)
    {
        $this->keys = $keys;

        return $this;
    }
}
