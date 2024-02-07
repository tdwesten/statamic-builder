<?php

namespace Tdwesten\StatamicBuilder\Enums;

enum OperatorOption: string
{
    case Equals = 'equals';
    case Not = 'not';
    case Contains = 'contains';
    case ContainsAny = 'contains_any';
    case IsIdentical = '===';
    case IsNotIdentical = '!==';
    case GreaterThan = '>';
    case GreaterThanOrEqual = '>=';
    case LessThan = '<';
    case LessThanOrEqual = '<=';
    case Custom = 'custom';
}
