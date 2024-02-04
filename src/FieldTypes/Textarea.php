<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Textarea extends Field
{
    use Makeble;

    protected $type = 'textarea';

    protected $characterLimit = null;

    protected $placeholder;

    public function __construct($handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'character_limit' => $this->characterLimit,
            'placeholder' => $this->placeholder,
        ]);
    }

    public function characterLimit(int $limit)
    {
        $this->characterLimit = $limit;

        return $this;
    }

    public function placeholder(string $placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }
}
