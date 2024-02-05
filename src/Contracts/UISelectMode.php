<?php

namespace Tdwesten\StatamicBuilder\Contracts;

use Tdwesten\StatamicBuilder\Enums\UIModeOption;

trait UISelectMode
{
    protected $mode = UIModeOption::StackSelector;

    public function mode(UIModeOption $mode)
    {
        $this->mode = $mode;

        return $this;
    }
}
