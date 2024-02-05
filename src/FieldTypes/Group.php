<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Contracts\Renderable;
use Tdwesten\StatamicBuilder\Helpers\FieldParser;

class Group extends Field implements Renderable
{
    use Makeble;

    protected $fields;

    protected $fullscreen = false;

    public function __construct(string $handle, $fields = [])
    {
        parent::__construct($handle);

        $this->type = 'group';
        $this->fields = $fields;

        return $this;
    }

    public static function make($handle, $fields = []): static
    {
        return new static($handle, $fields);
    }

    public function fullscreen(bool $fullscreen = true)
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
        $this->fields = FieldParser::parseMixedFieldsToFlatCollection($this->fields);

        return collect($this->fields)->map(function ($field) {
            return $field->toArray();
        })->all();
    }
}
