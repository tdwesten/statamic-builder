<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\DefaultValue;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class ButtonGroup extends Field
{
    use DefaultValue;
    use Makeble;

    protected $type = 'button_group';

    protected $options = [];

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'options' => $this->options,
        ]);
    }

    public function options(array $options): self
    {
        $this->options = $options;

        return $this;
    }
}
