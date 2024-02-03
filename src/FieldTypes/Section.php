<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

class Section extends Field
{
    protected $fields;

    protected $displayName;

    public function __construct($displayName, $fields = [])
    {
        $this->displayName = $displayName;
        $this->fields = collect($fields);
    }

    public static function make($displayName, array $fields = []): static
    {
        return new static($displayName, $fields);
    }

    public function toArray()
    {
        return [
            'display' => $this->displayName,
            'fields' => $this->fieldsToArray(),
        ];
    }

    public function fieldsToArray(): array
    {
        return $this->fields->map(function (Field $field) {
            return $field->toArray();
        })->toArray();
    }
}
