<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Renderable;
use Tdwesten\StatamicBuilder\Fieldset;

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

    public static function make($handle, $fields = [])
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
        $this->parseFieldsets();

        return collect($this->fields)->map(function ($field) {
            return $field->toArray();
        })->all();
    }

    public function parseFieldsets()
    {
        $this->fields = collect($this->fields)->map(function ($field) {
            if ($field instanceof Fieldset) {
                /** @var Fieldset */
                $fieldset = $field;

                return $fieldset->toArray();
            }

            return $field;
        })->flatten();
    }
}
