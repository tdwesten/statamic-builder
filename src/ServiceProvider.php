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

        $this->registerBlueprintRepository();

        $this->registerFieldsetRepository();

        $this->registerGlobalRepository();

        $this->registerCollectionRepository();

        $this->registerControllers();
    }

    protected function registerControllers()
    {
        $this->app->bind(\Statamic\Http\Controllers\CP\Collections\CollectionBlueprintsController::class, function () {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\CollectionBlueprintsController;
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Globals\GlobalsBlueprintController::class, function () {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\GlobalsBlueprintsController;
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Taxonomies\TaxonomyBlueprintsController::class, function () {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\TaxonomyBlueprintsController;
        });
    }

    protected function registerGlobalRepository()
    {
        $this->app->singleton(\Statamic\Stache\Repositories\GlobalRepository::class, function () {
            return new GlobalRepository(app('stache'));
        });
    }

    protected function registerFieldsetRepository()
    {
        $this->app->singleton(\Statamic\Fields\FieldsetRepository::class, function () {
            return (new \Tdwesten\StatamicBuilder\Repositories\FieldsetRepository)
                ->setDirectory(resource_path('fieldsets'));
        });
    }

    protected function registerCollectionRepository()
    {
        $this->app->singleton(\Statamic\Contracts\Entries\CollectionRepository::class, function () {
            return new \Tdwesten\StatamicBuilder\Repositories\CollectionRepository(app('stache'));
        });

        $this->app->singleton(\Statamic\Stache\Stores\CollectionsStore::class, function () {
            return new \Tdwesten\StatamicBuilder\Stache\Stores\CollectionsStore(app('stache'));
        });
    }

    protected function registerBlueprintRepository()
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
                Console\MakeCollectionCommand::class,
                Console\Importer::class,
                Console\Export::class,
            ]);
        }
    }
}
