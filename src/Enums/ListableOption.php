<?php

namespace Tdwesten\StatamicBuilder\Enums;

enum ListableOption: string
{
    case Hidden = 'hidden';
    case True = 'true';
    case False = 'false';

    public function toArray()
    {
        if ($this === ListableOption::Hidden) {
            return 'hidden';
        }

        if ($this === ListableOption::True) {
            return true;
        }

        return false;
    }
}
