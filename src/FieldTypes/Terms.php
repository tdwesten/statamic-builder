<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Terms extends Field
{
    use Makeble;

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

    public function maxItems(int $count)
    {
        $this->maxItems = $count;

        return $this;
    }

    public function taxonomies(array $taxonomies)
    {
        $this->taxonomies = collect($taxonomies);

        return $this;
    }

    public function mode(string $mode)
    {
        $this->mode = $mode;

        return $this;
    }

    public function create(bool $create)
    {
        $this->create = $create;

        return $this;
    }
}
