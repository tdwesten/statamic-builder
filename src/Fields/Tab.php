<?php

namespace Tdwesten\StatamicBuilder\Fields;

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
        return $this->content->map(function ($section) {
            return $section->toArray();
        })->toArray();

    }

    public function fieldsToArray(): array
    {
        return $this->content->map(function ($field) {
            return [$field->getHandle() => $field->toArray()];
        })->toArray();
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
