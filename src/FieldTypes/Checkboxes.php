<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\DefaultValue;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Checkboxes extends Field
{
    use DefaultValue;
    use Makeble;

    protected $type = 'checkboxes';

    protected $options = [];

    protected $inline = false;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'options' => $this->options,
            'default' => $this->default,
            'inline' => $this->inline,
        ]);
    }

    public function options(array $options)
    {
        $this->options = $options;

        return $this;
    }

    public function inline(bool $inline = true)
    {
        $this->inline = $inline;

        return $this;
    }
}
