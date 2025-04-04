<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\ConditionalLogic;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Contracts\Renderable;
use Tdwesten\StatamicBuilder\Enums\Icon;
use Tdwesten\StatamicBuilder\Enums\ListableOption;
use Tdwesten\StatamicBuilder\Enums\VisibilityOption;
use Tdwesten\StatamicBuilder\Exceptions\BlueprintRenderException;
use Tdwesten\StatamicBuilder\Helpers\FieldParser;

class Field implements Renderable
{
    use ConditionalLogic;
    use Makeble;

    protected $handle;

    protected $prefix;

    protected $type = 'text';

    protected $displayName;

    protected $instructions;

    protected $visibility = VisibilityOption::Visible;

    protected $required;

    protected $instructionsPosition = 'above';

    protected $listable = ListableOption::Hidden;

    protected $replicatorPreview = true;

    protected $duplicate = true;

    protected $antlers = false;

    protected $hideDisplay = false;

    protected $icon;

    protected $width;

    protected $customAttributes;

    protected $default;

    protected $fields;

    protected $localizable = false;

    /**
     * @var Collection
     */
    protected $validate;

    public function __construct($handle)
    {
        $this->handle = $handle;
        $this->type = $this->getType();
        $this->validate = new Collection([]);
    }

    public function toArray()
    {
        $fieldDefaults = $this->fieldDefaults();

        $this->validateField();

        $field = $fieldDefaults
            ->merge($this->fieldToArray())
            ->merge($this->conditionalLogicToArray())
            ->merge($this->customAttributes ?? []);

        $content = collect([
            'handle' => $this->getHandle(),
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

        return $content->toArray();
    }

    public function fieldDefaults(): Collection
    {
        return collect([
            'antlers' => $this->antlers,
            'display' => $this->displayName,
            'default' => $this->default,
            'duplicate' => $this->duplicate,
            'hide_display' => $this->hideDisplay,
            'icon' => $this->icon?->value,
            'instructions' => $this->instructions,
            'instructions_position' => $this->instructionsPosition,
            'listable' => $this->listable->toArray(),
            'replicator_preview' => $this->replicatorPreview,
            'required' => $this->required,
            'type' => $this->type,
            'visibility' => $this->visibility->value,
            'validate' => $this->validate->toArray(),
            'width' => $this->width,
            'localizable' => $this->localizable,
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

    public function withAttributes(array $attributes)
    {
        $this->customAttributes = $attributes;

        return $this;
    }

    public function getHandle()
    {
        if ($this->prefix) {
            return $this->prefix.'.'.$this->handle;
        }

        return $this->handle;
    }

    public function prefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
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

    public function visibility(VisibilityOption $visibility)
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

    public function validate(array $rules = [])
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

    public function listable(?ListableOption $listable = null)
    {
        $this->listable = $listable ?? ListableOption::True;

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

    public function icon(Icon $icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function width($width)
    {
        $this->width = $width;

        return $this;
    }

    public function type(string $type)
    {
        $this->type = $type;

        return $this;
    }

    public function default($default)
    {
        $this->default = $default;

        return $this;
    }

    public function localizable($localizable = true)
    {
        $this->localizable = $localizable;

        return $this;
    }

    public function fieldsToArray()
    {
        $this->fields = FieldParser::parseMixedFieldsToFlatCollection($this->fields);

        return collect($this->fields)->map(function ($field) {
            return $field->toArray();
        })->all();
    }

    public function validateField()
    {
        if ($this->getHandle() === null || empty($this->getHandle())) {
            throw new BlueprintRenderException('[ '.get_called_class().'] Field handle cannot be empty');
        }
    }
}
