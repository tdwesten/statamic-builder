<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Contracts\MaxItems;
use Tdwesten\StatamicBuilder\Contracts\UISelectMode;

class Relationship extends Field
{
    use Makeble;
    use MaxItems;
    use UISelectMode;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'max_items' => $this->max_items,
            'mode' => $this->mode->value,
        ]);
    }
}
