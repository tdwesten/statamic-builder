<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Enums\AutocompleteOption;
use Tdwesten\StatamicBuilder\Enums\InputTypeOption;

class Text extends Field
{
    protected $inputType = InputTypeOption::Text;

    protected $placeholder;

    protected $characterLimit;

    protected $autocomplete;

    protected $prepend;

    protected $append;

    public function __construct($handle)
    {
        parent::__construct($handle, 'text');
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'input_type' => $this->inputType->value,
            'placeholder' => $this->placeholder,
            'character_limit' => $this->characterLimit,
            'autocomplete' => $this->autocomplete?->value,
            'prepend' => $this->prepend,
            'append' => $this->append,
        ]);
    }

    public function inputType(InputTypeOption $inputType)
    {
        $this->inputType = $inputType;

        return $this;
    }

    public function placeholder(string $placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function characterLimit(int $characterLimit)
    {
        $this->characterLimit = $characterLimit;

        return $this;
    }

    public function autocomplete(AutocompleteOption $autocomplete)
    {
        $this->autocomplete = $autocomplete;

        return $this;
    }

    public function prepend(string $prepend)
    {
        $this->prepend = $prepend;

        return $this;
    }

    public function append(string $append)
    {
        $this->append = $append;

        return $this;
    }
}
