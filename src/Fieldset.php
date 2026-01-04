<?php

namespace Tdwesten\StatamicBuilder;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

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
            'title' => $this->getTitle(),
            'fields' => $this->fieldsToArray(),
        ];

    }

    public function getTitle(): string
    {
        $class = get_called_class();
        $slug = explode('\\', $class);

        $className = end($slug);
        $className = str_replace('Fieldset', '', $className);
        $className = Str::snake($className);

        return Str::title(str_replace('_', ' ', $className));
    }

    public function getSlug(): string
    {
        $class = get_called_class();
        $slug = explode('\\', $class);

        $className = end($slug);

        return Str::snake($className);
    }

    public function fieldsToArray(): array
    {
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

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }
}
