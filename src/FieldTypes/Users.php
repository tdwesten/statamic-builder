<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Contracts\MaxItems;
use Tdwesten\StatamicBuilder\Contracts\QueryScopes;
use Tdwesten\StatamicBuilder\Contracts\UISelectMode;

class Users extends Field
{
    use Makeble;
    use MaxItems;
    use QueryScopes;
    use UISelectMode;

    protected $type = 'users';

    protected $default;

    protected $queryScopes;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'max_items' => $this->maxItems,
            'mode' => $this->mode->value,
            'query_scopes' => $this->queryScopes,
        ]);
    }
}
