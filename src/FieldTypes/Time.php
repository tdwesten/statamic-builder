<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\DefaultValue;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Time extends Field
{
    use DefaultValue;
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
            'default' => $this->default,
        ]);
    }

    public function secondsEnabled()
    {
        $this->secondsEnabled = true;

        return $this;
    }
}
