<?php

namespace Tdwesten\StatamicBuilder\Enums;

enum BardInlineOption: string
{
    case True = 'true';
    case False = 'false';

    public function toArray()
    {
        if ($this === BardInlineOption::True) {
            return true;
        }

        return false;
    }
}
