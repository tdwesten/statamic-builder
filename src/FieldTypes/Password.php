<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Password extends Field
{
    use Makeble;

    protected $type = 'password';

    protected $placeholder;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'placeholder' => $this->placeholder,
        ]);
    }

    public function placeholder(string $placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }
}
