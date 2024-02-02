<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Enums\DateModeOption;

class Date extends Field
{
    use Makeble;

    protected $type = 'date';

    protected $mode = DateModeOption::Single;

    protected $inline = false;

    protected $fullWidth = false;

    protected $columns = 1;

    protected $rows = 1;

    protected $timeEnabled = false;

    protected $timeSecondsEnabled = false;

    protected $earliestDate;

    protected $latestDate;

    protected $format;

    protected $dateFormatForExport = 'Y-m-d';

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'mode' => $this->mode->value,
            'inline' => $this->inline,
            'full_width' => $this->fullWidth,
            'columns' => $this->columns,
            'rows' => $this->rows,
            'time_enabled' => $this->timeEnabled,
            'time_seconds_enabled' => $this->timeSecondsEnabled,
            'earliest_date' => $this->earliestDate ? $this->earliestDate->format($this->dateFormatForExport) : null,
            'latest_date' => $this->latestDate ? $this->latestDate->format($this->dateFormatForExport) : null,
            'format' => $this->format,
        ]);
    }

    public function mode(DateModeOption $mode)
    {
        $this->mode = $mode;

        return $this;
    }

    public function inline()
    {
        $this->inline = true;

        return $this;
    }

    public function fullWidth()
    {
        $this->fullWidth = true;

        return $this;
    }

    public function columns(int $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    public function rows(int $rows)
    {
        $this->rows = $rows;

        return $this;
    }

    public function timeEnabled()
    {
        $this->timeEnabled = true;

        return $this;
    }

    public function timeSecondsEnabled()
    {
        $this->timeSecondsEnabled = true;

        return $this;
    }

    public function earliestDate(Carbon $earliestDate)
    {
        $this->earliestDate = $earliestDate;

        return $this;
    }

    public function latestDate(Carbon $latestDate)
    {
        $this->latestDate = $latestDate;

        return $this;
    }

    public function format(string $format)
    {
        $this->format = $format;

        return $this;
    }
}
