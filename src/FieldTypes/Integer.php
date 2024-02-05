<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Append;
use Tdwesten\StatamicBuilder\Contracts\DefaultValue;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Contracts\Prepend;

class Integer extends Field
{
    use Append;
    use DefaultValue;
    use Makeble;
    use Prepend;

    protected $type = 'integer';

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'prepend' => $this->prepend,
            'append' => $this->append,
            'default' => $this->default,
        ]);
    }
}
