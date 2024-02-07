<?php

namespace Tdwesten\StatamicBuilder\Contracts;

use Tdwesten\StatamicBuilder\Enums\OperatorOption;

trait ConditionalLogic
{
    protected $if;

    protected $if_any;

    protected $unless;

    protected $unless_any;

    public function if(string $key, OperatorOption $oparator, $value)
    {
        if ($this->if === null) {
            $this->if = collect();
        }

        $this->if->put($key, "{$oparator->value} {$value}");

        return $this;
    }

    public function ifCustom(string $custom)
    {
        if ($this->if === null) {
            $this->if = collect();
        }

        $this->if->put('custom', $custom);

        return $this;
    }

    public function ifAny(string $key, OperatorOption $oparator, $value)
    {
        if ($this->if_any === null) {
            $this->if_any = collect();
        }

        $this->if_any->put($key, "{$oparator->value} {$value}");

        return $this;
    }

    public function ifAnyCustom(string $custom)
    {
        if ($this->if_any === null) {
            $this->if_any = collect();
        }

        $this->if_any->put('custom', $custom);

        return $this;
    }

    public function unless(string $key, OperatorOption $oparator, $value)
    {
        if ($this->unless === null) {
            $this->unless = collect();
        }

        $this->unless->put($key, "{$oparator->value} {$value}");

        return $this;
    }

    public function unlessCustom(string $custom)
    {
        if ($this->unless === null) {
            $this->unless = collect();
        }

        $this->unless->put('custom', $custom);

        return $this;
    }

    public function conditionalLogicToArray()
    {
        return [
            'if' => $this->if?->toArray(),
            'if_any' => $this->if_any?->toArray(),
            'unless' => $this->unless?->toArray(),
            'unless_any' => $this->unless_any?->toArray(),
        ];
    }
}
