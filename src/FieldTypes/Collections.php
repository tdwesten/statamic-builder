<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection as IlluminateCollection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Contracts\MaxItems;
use Tdwesten\StatamicBuilder\Contracts\UISelectMode;

class Collections extends Field
{
    use Makeble;
    use MaxItems;
    use UISelectMode;

    protected $type = 'collections';

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): IlluminateCollection
    {
        return collect([
            'max_items' => $this->maxItems,
            'mode' => $this->mode->value,
        ]);
    }
}
