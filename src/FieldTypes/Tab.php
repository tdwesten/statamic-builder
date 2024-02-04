<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Tdwesten\StatamicBuilder\Exceptions\BlueprintRenderException;
use Tdwesten\StatamicBuilder\Helpers\FieldParser;

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
        if ($this->content->isEmpty()) {
            return [];
        }

        $fields = $this->content->filter(function ($field) {
            return ! ($field instanceof Section);
        });

        if ($fields->isNotEmpty()) {
            throw new BlueprintRenderException('Only sections are allowed in tabs');
        }

        return $this->content->map(function (Section $section) {
            return $section->toArray();
        })->toArray();
    }

    public function fieldsToArray(): array
    {
        $this->content = FieldParser::parseMixedFieldsToFlatCollection($this->content);

        return $this->content->map(function ($field) {
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
