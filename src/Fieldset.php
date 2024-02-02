<?php

namespace Tdwesten\StatamicBuilder;

use Tdwesten\StatamicBuilder\FieldTypes\Field;

class Fieldset
{
    protected $prefix = null;

    protected $fields;

    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
        $this->fields = $this->registerFields();
    }

    public static function make(string $prefix)
    {
        return new static($prefix);
    }

    public function registerFields(): array
    {
        return [];
    }

    public function toArray(): array
    {
        return collect($this->fields)->map(function (Field $field) {
            return $field->prefix($this->prefix);
        })->toArray();
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }
}
