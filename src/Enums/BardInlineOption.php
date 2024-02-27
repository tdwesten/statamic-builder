<?php

namespace Tdwesten\StatamicBuilder\Enums;

enum BardInlineOption: string
{
    case True = 'true';
    case False = 'false';
    case Break = 'break';

    public function toArray()
    {
        if ($this === BardInlineOption::Break) {
            return 'accordion';
        }

        if ($this === BardInlineOption::True) {
            return true;
        }

        return false;
    }
}
