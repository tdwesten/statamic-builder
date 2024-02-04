<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Time extends Field
{
    use Makeble;

    protected $type = 'time';

    protected $secondsEnabled = false;

    public function __construct($handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'seconds_enabled' => $this->secondsEnabled,
        ]);
    }

    public function secondsEnabled()
    {
        $this->secondsEnabled = true;

        return $this;
    }
}
