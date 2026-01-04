<?php

namespace Tdwesten\StatamicBuilder;

use Statamic\Facades\GlobalSet as StatamicGlobalSet;
use Statamic\Facades\Site;

abstract class BaseGlobalSet
{
    abstract public static function handle(): string;

    public function title(): string
    {
        return (string) \Statamic\Support\Str::of(static::handle())->title()->replace('_', ' ');
    }

    public function sites(): array
    {
        return [Site::default()->handle()];
    }

    public function register()
    {
        /** @var StatamicGlobalSet */
        $global = StatamicGlobalSet::make($this->handle())
            ->title($this->title());

        $sites = $this->sites() ?? [\Statamic\Facades\Site::default()->handle()];

        foreach ($sites as $site) {
            if (! $global->in($site)) {
                $global->addLocalization($global->makeLocalization($site));
            }
        }

        return $global;
    }
}
