<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\DefaultValue;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Select extends Field
{
    use DefaultValue;
    use Makeble;

    protected $type = 'select';

    protected $taggable = false;

    protected $push_tags = false;

    protected $placeholder;

    protected $multiple = false;

    protected $max_items = 1;

    protected $clearable = false;

    protected $searchable = true;

    protected $cast_booleans = false;

    protected $options = [];

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'taggable' => $this->taggable,
            'push_tags' => $this->push_tags,
            'placeholder' => $this->placeholder,
            'multiple' => $this->multiple,
            'max_items' => $this->max_items,
            'clearable' => $this->clearable,
            'searchable' => $this->searchable,
            'cast_booleans' => $this->cast_booleans,
            'options' => $this->options,
        ]);
    }

    public function options(array $options)
    {
        $this->options = $options;

        return $this;
    }

    public function taggable(bool $taggable = true)
    {
        $this->taggable = $taggable;

        return $this;
    }

    public function pushTags(bool $push = true)
    {
        $this->push_tags = $push;

        return $this;
    }

    public function placeholder(string $placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function multiple(bool $multiple = true)
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function maxItems(int $max)
    {
        $this->max_items = $max;

        return $this;
    }

    public function clearable(bool $clearable = true)
    {
        $this->clearable = $clearable;

        return $this;
    }

    public function searchable(bool $searchable = true)
    {
        $this->searchable = $searchable;

        return $this;
    }

    public function castBooleans(bool $cast = true)
    {
        $this->cast_booleans = $cast;

        return $this;
    }
}
