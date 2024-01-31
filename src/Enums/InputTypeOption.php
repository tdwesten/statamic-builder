<?php

namespace Tdwesten\StatamicBuilder\Enums;

enum InputTypeOption: string
{
    case Color = 'color';
    case Date = 'date';
    case Email = 'email';
    case Hidden = 'hidden';
    case Month = 'month';
    case Number = 'number';
    case Password = 'password';
    case Tel = 'tel';
    case Text = 'text';
    case Time = 'time';
    case Url = 'url';
    case Week = 'week';
}
