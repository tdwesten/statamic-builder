<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Dictionary extends Field
{
    use Makeble;

    protected $type = 'dictionary';

    protected string $dictionaryType = '';

    protected array $dictionaryOptions = [];

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
}
