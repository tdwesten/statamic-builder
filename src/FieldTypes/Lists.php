<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Lists extends Field
{
    use Makeble;

    protected $type = 'list';

    protected $default;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'default' => $this->default,
        ]);
    }

    public function default($default)
    {
        $this->default = $default;

        return $this;
    }
}
