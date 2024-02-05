<?php

namespace Tdwesten\StatamicBuilder;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Helpers\FieldParser;

class Fieldset
{
    protected $prefix = null;

    protected $fields;

    public function __construct(?string $prefix = null)
    {
        $this->prefix = $prefix;
        $this->fields = $this->registerFields();
    }

    public static function make(?string $prefix = null)
    {
        return new static($prefix);
    }

    public function registerFields(): array
    {
        return [];
    }

    public function toArray(): array
    {
        return [
            'import' => $this->getSlug(),
            'prefix' => $this->prefix,
        ];
    }

    public function fieldsetToArray(): array
    {
        return [
            'title' => $this->getSlug(),
            'fields' => $this->fieldsToArray(),
        ];

    }

    public function getSlug(): string
    {
        return $this->generateSlug();
    }

    public function generateSlug(): string
    {
        $class = get_called_class();
        $slug = explode('\\', $class);

        return strtolower(end($slug));
    }

    public function fieldsToArray(): array
    {

        $this->fields = FieldParser::parseMixedFieldsToFlatCollection($this->fields);

        return collect($this->fields)->map(function ($field) {
            return $field->prefix($this->prefix)->toArray();
        })->toArray();
    }

    public function getFields(): Collection
    {
        return collect($this->fields)->map(function ($field) {
            return $field->prefix($this->prefix);
        });
    }

    public function prefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }
}
