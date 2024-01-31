<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Renderable;

class Group extends Field implements Renderable
{
    protected $fields;

    protected $fullscreen = true;

    public function __construct(string $handle, $fields = [])
    {
        parent::__construct($handle);

        $this->type = 'group';
        $this->fields = $fields;

        return $this;
    }

    public static function make($handle, $fields = []): self
    {
        return new static($handle, $fields);
    }

    public function fullscreen(bool $fullscreen = true): self
    {
        $this->fullscreen = $fullscreen;

        return $this;
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'fullscreen' => $this->fullscreen,
            'fields' => $this->fieldsToArray(),
        ]);
    }

    public function fieldsToArray()
    {
        return collect($this->fields)->map(function ($field) {
            return $field->toArray();
        })->all();
    }
}
