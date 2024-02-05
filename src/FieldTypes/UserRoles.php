<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Contracts\MaxItems;
use Tdwesten\StatamicBuilder\Contracts\UISelectMode;

class UserRoles extends Field
{
    use Makeble;
    use MaxItems;
    use UISelectMode;

    protected $type = 'user_roles';

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'max_items' => $this->maxItems,
            'mode' => $this->mode->value,
        ]);
    }
}
