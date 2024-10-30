<?php

namespace Tdwesten\StatamicBuilder\Sites;

use Illuminate\Support\Facades\Cache;
use Statamic\Sites\Sites as StatamicSites;

class Sites extends StatamicSites
{
    protected function getSavedSites()
    {
        return Cache::rememberForever('statamic.builder.sites', function () {
            return collect(config('statamic.builder.sites'))
                ->mapWithKeys(function ($site) {
                    $site = new $site;
                    return [$site->handle() => $site->toArray()];
                })
                ->toArray()
                ?: $this->getFallbackConfig();
        });
    }

}