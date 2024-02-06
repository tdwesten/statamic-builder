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

        $this->app->bind(\Statamic\Fields\FieldsetRepository::class, function () {
            return (new \Tdwesten\StatamicBuilder\Repositories\FieldsetRepository)
                ->setDirectory(resource_path('fieldsets'));
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Collections\CollectionBlueprintsController::class, function () {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\CollectionBlueprintsController;
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Globals\GlobalsBlueprintController::class, function () {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\GlobalesBlueprintsController;
        });
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'statamic-builder');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/builder.php' => config_path('statamic/builder.php'),
            ], 'statamic');

            $this->commands([
                Console\MakeBlueprint::class,
                Console\MakeFieldset::class,
            ]);
        }
    }
}
