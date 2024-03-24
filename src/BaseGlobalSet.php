<?php

namespace Tdwesten\StatamicBuilder;

use Statamic\Facades\GlobalSet as StatamicGlobalSet;
use Statamic\Facades\Site;

abstract class BaseGlobalSet
{
    abstract public static function handle(): string;

    abstract public function title(): string;

    abstract public function sites(): array;

    public function register()
    {
        /** @var StatamicGlobalSet */
        $global = StatamicGlobalSet::make($this->handle())
            ->title($this->title());

        $sites = $this->sites() ?? [Site::default()->handle()];

        foreach ($sites as $site) {
            $global->addLocalization($global->makeLocalization($site));
        }

        return $global;
    }
}
