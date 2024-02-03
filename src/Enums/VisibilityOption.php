<?php

namespace Tdwesten\StatamicBuilder\Enums;

enum VisibilityOption: string
{
    case ReadOnly = 'read_only';
    case Visible = 'visible';
    case Hidden = 'hidden';
    case Computed = 'computed';
}
