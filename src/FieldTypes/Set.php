<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Set extends Field
{
    use Makeble;

    protected $type = 'set';

    protected $fields;

    public function __construct(string $handle, array $fields = [])
    {
        parent::__construct($handle);

        $this->fields = collect($fields);
    }

    public function toArray()
    {
        $content = collect([
            'display' => $this->displayName,
            'instructions' => $this->instructions,
            'icon' => $this->icon,
            'fields' => $this->fieldsToArray(),
        ]);

        // Sort keys
        $content = $content->sortKeys();

        return $content->toArray();
    }
}
