<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

class Terms extends Field
{
    protected $type = 'terms';

    protected $maxItems;

    protected $taxonomies;

    protected $mode = 'default';

    protected $create = true;

    protected $icon = 'taxonomy';

    protected $queryScopes;

    public function __construct($handle)
    {
        parent::__construct($handle, 'text');
    }

    public function fieldToArray(): array
    {
        return [
            'type' => 'terms',
            'max_items' => $this->maxItems,
            'taxonomies' => $this->taxonomies,
            'mode' => $this->mode,
            'create' => $this->create,
        ];
    }

    public static function make($handle): self
    {
        return new self($handle);
    }

    public function maxItems(int $count): self
    {
        $this->maxItems = $count;

        return $this;
    }

    public function taxonomies(array $taxonomies): self
    {
        $this->taxonomies = $taxonomies;

        return $this;
    }

    public function mode(string $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function create(bool $create): self
    {
        $this->create = $create;

        return $this;
    }
}
