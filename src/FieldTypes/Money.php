<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\DefaultValue;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Money extends Field
{
    use DefaultValue;
    use Makeble;

    protected $type = 'money';

    protected $currency;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'default' => $this->default,
            'currency' => $this->currency,
        ]);
    }

    public function currency(string $currency)
    {
        $this->currency = $currency;

        return $this;
    }
}
