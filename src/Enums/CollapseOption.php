<?php

namespace Tdwesten\StatamicBuilder\Enums;

enum CollapseOption: string
{
    case False = 'false';
    case True = 'true';
    case Accordion = 'accordion';

    public function toArray()
    {
        if ($this === CollapseOption::Accordion) {
            return 'accordion';
        }

        if ($this === CollapseOption::True) {
            return true;
        }

        return false;
    }
}
