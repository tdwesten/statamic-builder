<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Contracts\MaxItems;
use Tdwesten\StatamicBuilder\Contracts\QueryScopes;
use Tdwesten\StatamicBuilder\Contracts\UISelectMode;
use Tdwesten\StatamicBuilder\Enums\Icon;

class Terms extends Field
{
    use Makeble;
    use MaxItems;
    use QueryScopes;
    use UISelectMode;

    protected $type = 'terms';

    /**
     * @var Collection
     */
    protected $taxonomies;

    protected $create = true;

    protected $icon = Icon::Taxonomy;

    protected $queryScopes;

    public function __construct($handle)
    {
        parent::__construct($handle, 'text');
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'max_items' => $this->max_items,
            'taxonomies' => $this->taxonomies?->toArray(),
            'mode' => $this->mode->value,
            'create' => $this->create,
            'query_scopes' => $this->queryScopes,
        ]);
    }

    public function taxonomies(array $taxonomies)
    {
        $this->taxonomies = collect($taxonomies);

        return $this;
    }

    public function create(bool $create = true)
    {
        $this->create = $create;

        return $this;
    }
}
