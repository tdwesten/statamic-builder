<?php

namespace Tdwesten\StatamicBuilder;

use Statamic\Providers\AddonServiceProvider;
use Tdwesten\StatamicBuilder\Repositories\GlobalRepository;

class ServiceProvider extends AddonServiceProvider
{
    public function bootAddon()
    {
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/builder.php', 'builder');

        $this->registerBlueprints();

        $this->app->bind(\Statamic\Fields\FieldsetRepository::class, function () {
            return (new \Tdwesten\StatamicBuilder\Repositories\FieldsetRepository)
                ->setDirectory(resource_path('fieldsets'));
        });

        $this->app->bind(\Statamic\Stache\Repositories\GlobalRepository::class, function () {
            return new GlobalRepository(app('stache'));
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Collections\CollectionBlueprintsController::class, function () {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\CollectionBlueprintsController;
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Globals\GlobalsBlueprintController::class, function () {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\GlobalesBlueprintsController;
        });

    }

    protected function registerBlueprints()
    {
        $this->app->singleton(\Statamic\Fields\BlueprintRepository::class, function () {
            return (new \Tdwesten\StatamicBuilder\Repositories\BlueprintRepository)
                ->setDirectory(resource_path('blueprints'))
                ->setFallback('default', function () {
                    return \Statamic\Facades\Blueprint::makeFromFields([
                        'title' => ['type' => 'text', 'localizable' => true],
                    ]);
                });
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
                Console\MakeBlueprintCommand::class,
                Console\MakeFieldsetCommand::class,
                Console\Importer::class,
                Console\Export::class,
            ]);
        }
    }
}
