<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Radio extends Field
{
    use Makeble;

    protected $type = 'radio';

    protected $options = [];

    protected $inline = false;

    protected $castBooleans = false;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'options' => $this->options,
            'inline' => $this->inline,
            'cast_booleans' => $this->castBooleans,
        ]);
    }

    public function options(array $options)
    {
        $this->options = $options;

        return $this;
    }

    public function inline()
    {
        $this->inline = true;

        return $this;
    }

    public function castBooleans()
    {
        $this->castBooleans = true;

        return $this;
    }
}
