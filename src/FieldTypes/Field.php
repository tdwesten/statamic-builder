<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Renderable;

class Field implements Renderable
{
    protected $handle;

    protected $type;

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
        $this->type = $type;
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
        $content = [
            'handle' => $this->handle,
            'field' => [
                'display' => $this->displayName,
                'type' => $this->type,
                'validate' => $this->validateToArray(),
                'instructions' => $this->instructions,
                'instructions_position' => $this->instructionsPosition,
                'required' => $this->required,
                'visibility' => $this->visibility,
                'listable' => $this->listable,
                'replicator_preview' => $this->replicatorPreview,
                'duplicate' => $this->duplicate,
                'antlers' => $this->antlers,
                'hide_display' => $this->hideDisplay,
                'width' => $this->width,
                'icon' => $this->icon,
            ],
        ];

        $field = $this->fieldToArray();

        $content['field'] = array_merge($content['field'], $field);

        $content['field'] = array_filter($content['field'], function ($item) {
            return is_array($item)
                ? ! empty($item)
                : ! in_array($item, [null, ''], true);
        });

        return $content;
    }

    public function fieldToArray(): array
    {
        return [];
    }

    public function validateToArray(): array
    {
        return $this->validate->toArray();
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

    public function visibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function required()
    {
        $this->required = true;

        $this->validate('required');

        return $this;
    }

    public function validate($rules): self
    {
        if ($this->validate === null) {
            $this->validate = new Collection([]);
        }

        if (is_string($rules)) {
            $this->validate->push($rules);
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
