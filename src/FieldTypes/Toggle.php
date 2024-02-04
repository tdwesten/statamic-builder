<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Toggle extends Field
{
    use Makeble;

    protected $type = 'toggle';

    protected $inlineLabel;

    protected $inlineLabelWhenTrue;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'inline_label' => $this->inlineLabel,
            'inline_label_when_true' => $this->inlineLabelWhenTrue,
        ]);
    }

    public function inlineLabel(string $label)
    {
        $this->inlineLabel = $label;

        return $this;
    }

    public function inlineLabelWhenTrue(string $label)
    {
        $this->inlineLabelWhenTrue = $label;

        return $this;
    }
}
