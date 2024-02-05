<?php

namespace Tdwesten\StatamicBuilder\Enums;

enum UIModeOption: string
{
    case StackSelector = 'default';
    case Select = 'select';
    case Typeahead = 'typeahead';
}
