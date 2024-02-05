<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Yaml extends Field
{
    use Makeble;

    protected $type = 'yaml';

    protected $default = '';

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

    public function default(string $default)
    {
        $this->default = $default;

        return $this;
    }
}
