<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Enums\RevealerModeUI;

class Revealer extends Field
{
    use Makeble;

    protected $type = 'revealer';

    protected $input_label;

    protected RevealerModeUI $mode = RevealerModeUI::Button;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'mode' => $this->mode,
            'input_label' => $this->input_label,
        ]);
    }

    public function mode(RevealerModeUI $mode)
    {
        $this->mode = $mode;

        return $this;
    }

    public function inputLabel(string $input_label)
    {
        $this->input_label = $input_label;

        return $this;
    }
}
