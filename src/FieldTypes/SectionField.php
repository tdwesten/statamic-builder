<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Tdwesten\StatamicBuilder\Contracts\Makeble;

class SectionField extends Field
{
    use Makeble;

    protected $type = 'section';
}
