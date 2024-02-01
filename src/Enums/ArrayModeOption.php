<?php

namespace Tdwesten\StatamicBuilder\Enums;

enum ArrayModeOption: string
{
    case Dynamic = 'dynamic';
    case Keyed = 'keyed';
    case Single = 'single';
}
