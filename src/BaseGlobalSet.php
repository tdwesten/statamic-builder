<?php

namespace Tdwesten\StatamicBuilder;

use Statamic\Facades\GlobalSet as StatamicGlobalSet;

abstract class BaseGlobalSet
{
    abstract public static function handle(): string;

    abstract public function title(): string;

    public function register()
    {
        /** @var StatamicGlobalSet */
        $globalSet = StatamicGlobalSet::make($this->handle())
            ->title($this->title());

        return $globalSet;
    }
}
