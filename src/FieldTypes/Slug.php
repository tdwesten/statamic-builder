<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Slug extends Field
{
    use Makeble;

    protected $type = 'slug';

    protected $from = 'title';

    protected $generate = true;

    protected $show_regenerate = false;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'from' => $this->from,
            'generate' => $this->generate,
            'show_regenerate' => $this->show_regenerate,
        ]);
    }

    public function from(string $from)
    {
        $this->from = $from;

        return $this;
    }

    public function generate(bool $generate = true)
    {
        $this->generate = $generate;

        return $this;
    }

    public function showRegenerate(bool $show = true)
    {
        $this->show_regenerate = $show;

        return $this;
    }
}
