<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

class Text extends Field
{
    public function __construct($handle)
    {
        parent::__construct($handle, 'text');
    }
}
