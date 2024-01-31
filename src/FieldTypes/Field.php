<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Renderable;

class Field implements Renderable
{
    protected $handle;

    protected $type = 'text';

    protected $displayName;

    protected $instructions;

    protected $visibility = 'visible';

    protected $required;

    protected $instructionsPosition = 'above';

    protected $listable = 'hidden';

    protected $replicatorPreview = true;

    protected $duplicate = true;

    protected $antlers = false;

    protected $hideDisplay = false;

    protected $icon;

    protected $width;

    /**
     * @var Collection
     */
    protected $validate;

    public function __construct($handle, $type = null)
    {
        $this->handle = $handle;
        $this->type = $this->getType();
        $this->validate = new Collection([]);
    }

    /**
     * Make a new field.
     *
     * @param  string  $handle
     * @return Field
     */
    public static function make($handle)
    {
        return new static($handle);
    }

    public function toArray()
    {
        $fieldDefaults = $this->fieldDefaults();

        $field = $fieldDefaults->merge($this->fieldToArray());

        $content = collect([
            'handle' => $this->handle,
            'field' => $field,
        ]);

        // Remove empty values
        $content['field'] = collect($content['field'])->filter(function ($item) {
            return is_array($item)
                ? ! empty($item)
                : ! in_array($item, [null, ''], true);
        })->all();

        // Sort keys
        $content['field'] = collect($content['field'])->sortKeys()->all();

        ray($content->toArray())->label('Field '.$this->type);

        return $content->toArray();
    }

    public function fieldDefaults(): Collection
    {
        return collect([
            'antlers' => $this->antlers,
            'display' => $this->displayName,
            'duplicate' => $this->duplicate,
            'hide_display' => $this->hideDisplay,
            'instructions' => $this->instructions,
            'instructions_position' => $this->instructionsPosition,
            'listable' => $this->listable,
            'replicator_preview' => $this->replicatorPreview,
            'required' => $this->required,
            'type' => $this->type,
            'visibility' => $this->visibility,
            'validate' => $this->validate->toArray(),
            'width' => $this->width,
        ]);
    }

    public function fieldToArray(): Collection
    {
        return collect([]);
    }

    public function validateToArray(): array
    {
        return $this->validate->toArray();
    }

    public function getHandle()
    {
        return $this->handle;
    }

    public function getType()
    {
        return $this->type;
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

    public function visibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function required()
    {
        $this->required = true;
        $this->validate->push('required');

        return $this;
    }

    public function sometimes()
    {
        $this->validate->push('sometimes');

        return $this;
    }

    public function validate(array $rules = []): self
    {
        if ($this->validate === null) {
            $this->validate = new Collection([]);
        }

        $rules = $this->validate->merge($rules)->unique();

        $this->validate = $rules;

        return $this;
    }

    public function instructionsPosition($instructionsPosition)
    {
        $this->instructionsPosition = $instructionsPosition;

        return $this;
    }

    public function instructionsPositionAbove()
    {
        $this->instructionsPosition = 'above';

        return $this;
    }

    public function instructionsPositionBelow()
    {
        $this->instructionsPosition = 'below';

        return $this;
    }

    public function listable()
    {
        $this->listable = true;

        return $this;
    }

    public function replicatorPreview(bool $replicatorPreview)
    {
        $this->replicatorPreview = $replicatorPreview;

        return $this;
    }

    public function duplicate(bool $duplicate)
    {
        $this->duplicate = $duplicate;

        return $this;
    }

    public function antlers(bool $antlers)
    {
        $this->antlers = $antlers;

        return $this;
    }

    public function hideDisplay(bool $hideDisplay)
    {
        $this->hideDisplay = $hideDisplay;

        return $this;
    }

    public function icon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function width($width)
    {
        $this->width = $width;

        return $this;
    }
}
