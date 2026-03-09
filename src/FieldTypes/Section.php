<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

class Section extends Field
{
    protected $fields;

    protected $displayName;

    protected ?bool $collapsible = null;

    protected ?bool $collapsed = null;

    public function __construct(string $displayName, array $fields = [])
    {
        $this->displayName = $displayName;
        $this->fields = collect($fields);
    }

    public static function make($displayName, array $fields = []): static
    {
        return new static($displayName, $fields);
    }

    public function collapsible(bool $collapsible = true): static
    {
        $this->collapsible = $collapsible;

        return $this;
    }

    public function collapsed(bool $collapsed = true): static
    {
        $this->collapsed = $collapsed;

        return $this;
    }

    public function toArray(): array
    {
        return collect([
            'display' => $this->displayName,
            'instructions' => $this->instructions,
            'collapsible' => $this->collapsible,
            'collapsed' => $this->collapsible === true ? ($this->collapsed ?? false) : null,
            'fields' => $this->fieldsToArray(),
        ])->filter(function ($item) {
            return ! in_array($item, [null, ''], true);
        })->toArray();
    }

    public function fieldsToArray(): array
    {
        return $this->fields->map(function ($field) {
            return $field->toArray();
        })->toArray();
    }
}
