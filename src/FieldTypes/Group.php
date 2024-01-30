<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Tdwesten\StatamicBuilder\Contracts\Renderable;

class Group extends Field implements Renderable
{
    protected $fields;

    protected $fullscreen = true;

    protected $type = 'group';

    public function __construct($handle, $fields = [])
    {
        parent::__construct($handle);

        $this->type = 'group';
        $this->fields = $fields;
    }

    public static function make($handle = null, $fields = []): self
    {
        return new static($handle, $fields);
    }

    public function toArray()
    {
        $content = parent::toArray();

        $content['field']['fields'] = $this->fieldsToArray();

        return $content;

    }

    public function fullscreen(bool $fullscreen = true): self
    {
        $this->fullscreen = $fullscreen;

        return $this;
    }

    public function fieldsToArray()
    {
        return collect($this->fields)->map(function ($field) {
            return $field->toArray();
        })->all();
    }
}
