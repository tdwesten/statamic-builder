<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Fullscreen;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Enums\GridModeOption;

class Grid extends Field
{
    use Fullscreen;
    use Makeble;

    protected $type = 'grid';

    protected $reorderable = true;

    protected $add_row;

    protected $max_rows;

    protected $min_rows;

    protected $mode = GridModeOption::Table;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'fullscreen' => $this->fullscreen,
            'reorderable' => $this->reorderable,
            'add_row' => $this->add_row,
            'max_rows' => $this->max_rows,
            'min_rows' => $this->min_rows,
            'mode' => $this->mode->value,
        ]);
    }

    public function reorderable(bool $reorderable = true): self
    {
        $this->reorderable = $reorderable;

        return $this;
    }

    public function addRow(string $add_row): self
    {
        $this->add_row = $add_row;

        return $this;
    }

    public function maxRows(int $max_rows): self
    {
        $this->max_rows = $max_rows;

        return $this;
    }

    public function minRows(int $min_rows): self
    {
        $this->min_rows = $min_rows;

        return $this;
    }

    public function mode(GridModeOption $mode): self
    {
        $this->mode = $mode;

        return $this;
    }
}
