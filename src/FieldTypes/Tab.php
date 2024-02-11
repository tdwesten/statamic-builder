<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Tdwesten\StatamicBuilder\Exceptions\BlueprintRenderException;
use Tdwesten\StatamicBuilder\Helpers\FieldParser;

class Tab
{
    protected $handle;

    protected $displayName;

    protected $sections;

    protected $instructions;

    public function __construct($handle, $sections = [])
    {
        $this->handle = $handle;

        $this->sections = collect($sections);
    }

    public static function make($handle, $sections = [])
    {
        return new static($handle, $sections);
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
        if ($this->sections->isEmpty()) {
            return [];
        }

        $fields = $this->sections->filter(function ($field) {
            return ! ($field instanceof Section);
        });

        if ($fields->isNotEmpty()) {
            throw new BlueprintRenderException('Only sections are allowed in tabs');
        }

        return $this->sections->map(function (Section $section) {
            return $section->toArray();
        })->toArray();
    }

    public function fieldsToArray(): array
    {
        $this->sections = FieldParser::parseMixedFieldsToFlatCollection($this->sections);

        return $this->sections->map(function ($field) {
            return $field->toArray();
        })->toArray();
    }

    public function toArray()
    {
        $content = [
            'display' => $this->displayName,
            'sections' => $this->sectionsToArray(),
        ];

        return $content;
    }
}
