<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Contracts\MaxItems;
use Tdwesten\StatamicBuilder\Contracts\QueryScopes;

class Form extends Field
{
    use Makeble;
    use MaxItems;
    use QueryScopes;

    protected $type = 'form';

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'max_items' => $this->max_items,
            'query_scopes' => $this->queryScopes,
        ]);
    }
}
