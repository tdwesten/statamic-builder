<?php

namespace Tdwesten\StatamicBuilder;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function bootAddon()
    {
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/builder.php', 'builder');

        $this->app->bind(\Statamic\Fields\BlueprintRepository::class, function () {
            return (new \Tdwesten\StatamicBuilder\Repositories\BlueprintRepository)
                ->setDirectory(resource_path('blueprints'))
                ->setFallback('default', function () {
                    return \Statamic\Facades\Blueprint::makeFromFields([
                        'content' => ['type' => 'markdown', 'localizable' => true],
                    ]);
                });
        });
    }

    public function boot()
    {
        // $this->app->bind(\Statamic\Fields\BlueprintRepository::class, \Tdwesten\StatamicBuilder\Repositories\BlueprintRepository::class);

        // parent::boot();

        $this->publishes([
            __DIR__.'/../config/builder.php' => config_path('builder.php'),
        ], 'statamic');
    }
}
