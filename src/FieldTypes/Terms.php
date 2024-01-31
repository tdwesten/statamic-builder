<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;

class Terms extends Field
{
    protected $type = 'terms';

    protected $maxItems;

    /**
     * @var Collection
     */
    protected $taxonomies;

    protected $mode = 'default';

    protected $create = true;

    protected $icon = 'taxonomy';

    protected $queryScopes;

    public function __construct($handle)
    {
        parent::__construct($handle, 'text');
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'max_items' => $this->maxItems,
            'taxonomies' => $this->taxonomies->toArray(),
            'mode' => $this->mode,
            'create' => $this->create,
        ]);
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
        $this->taxonomies = collect($taxonomies);

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
