<?php

namespace Tdwesten\StatamicBuilder\Enums;

enum ListableOption: string
{
    case Hidden = 'hidden';
    case True = 'true';
    case False = 'false';

    public function toArray(): bool|string
    {
        return match ($this) {
            ListableOption::Hidden => 'hidden',
            ListableOption::True => true,
            ListableOption::False => false,
        };
    }
}
