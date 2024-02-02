<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Tdwesten\StatamicBuilder\Fieldset;

class Tab
{
    protected $handle;

    protected $displayName;

    protected $content;

    protected $instructions;

    public function __construct($handle, $content = [])
    {
        $this->handle = $handle;

        $this->content = collect($content);
    }

    public static function make($handle)
    {
        return new static($handle);
    }

    public function getHandle()
    {
        return $this->handle;
    }

    public function displayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function instructions($instructions)
    {
        $this->instructions = $instructions;

        return $this;
    }

    public function sectionsToArray(): ?array
    {
        if ($this->content->first() instanceof Section) {
            return $this->content->map(function (Section $section) {
                return $section->toArray();
            })->toArray();
        } else {
            return null;
        }
    }

    public function fieldsToArray(): array
    {
        $this->parseFieldsets();

        return $this->content->map(function (Field $field) {
            return [$field->getHandle() => $field->toArray()];
        })->toArray();
    }

    public function parseFieldsets()
    {
        $this->content = $this->content->map(function ($field) {
            if ($field instanceof Fieldset) {

                /** @var Fieldset */
                $fieldset = $field;

                return $fieldset->toArray();
            }

            return $field;
        })->flatten();
    }

    public function toArray()
    {
        $content = [
            'display' => $this->displayName,
        ];

        if ($sections = $this->sectionsToArray()) {
            $content['sections'] = $sections;
        } else {
            $content['fields'] = $this->fieldsToArray();
        }

        return $content;
    }
}
