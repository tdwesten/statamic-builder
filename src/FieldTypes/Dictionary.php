<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\MaxItems;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Dictionary extends Field
{
    use Makeble;
    use MaxItems;

    protected $type = 'dictionary';

    protected string $dictionaryType = '';

    protected array $dictionaryOptions = [];

    protected string $placeholder = '';

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'dictionary' => [
                'type' => $this->dictionaryType,
                ...$this->dictionaryOptions,
            ],
            'placeholder' => $this->placeholder,
            'max_items' => $this->max_items,
        ]);
    }

    /**
     * Set the dictionary type.
     */
    public function dictionaryType(string $type): self
    {
        $this->dictionaryType = $type;

        return $this;
    }

    /**
     * Set the dictionary options. e.g. ['region' => 'africa']
     */
    public function dictionaryOptions(array $attributes): self
    {
        $this->dictionaryOptions = $attributes;

        return $this;
    }

    /**
     * Set the non-selectable placeholder text. Default: none.
     */
    public function placeholder(string $placeholder): self {
        $this->placeholder = $placeholder;

        return $this;
    }
}
