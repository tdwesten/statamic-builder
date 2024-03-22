<?php

namespace Tdwesten\StatamicBuilder;

use Illuminate\Http\Request;
use Statamic\Providers\AddonServiceProvider;
use Tdwesten\StatamicBuilder\Repositories\AssetContainerRepository;
use Tdwesten\StatamicBuilder\Repositories\GlobalRepository;
use Tdwesten\StatamicBuilder\Repositories\NavigationRepository;

class ServiceProvider extends AddonServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/builder.php', 'builder');

        $this->bindRepositories();

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

        $this->app->bind(\Statamic\Http\Controllers\CP\Navigation\NavigationBlueprintController::class, function () {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\NavigationBlueprintController;
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Assets\AssetContainerBlueprintController::class, function () {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\AssetContainerBlueprintController(
                app('request')
            );
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Collections\CollectionsController::class, function ($app) {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\CollectionsController(
                $app->make(Request::class),
                $app->make(\Tdwesten\StatamicBuilder\Repositories\CollectionRepository::class)
            );
        });

    }

    protected function bindRepositories()
    {
        $this->app->singleton(\Statamic\Stache\Repositories\AssetContainerRepository::class, function () {
            return new AssetContainerRepository(app('stache'));
        });

        $this->app->singleton(\Statamic\Stache\Repositories\GlobalRepository::class, function () {
            return new GlobalRepository(app('stache'));
        });

        $this->app->singleton(\Statamic\Fields\FieldsetRepository::class, function () {
            return (new \Tdwesten\StatamicBuilder\Repositories\FieldsetRepository)
                ->setDirectory(resource_path('fieldsets'));
        });

        $this->app->singleton(\Statamic\Stache\Repositories\NavigationRepository::class, function () {
            return new NavigationRepository(app('stache'));
        });

        $this->app->singleton(\Statamic\Contracts\Entries\CollectionRepository::class, function () {
            return new \Tdwesten\StatamicBuilder\Repositories\CollectionRepository(app('stache'));
        });

        $this->app->singleton(\Statamic\Stache\Stores\CollectionsStore::class, function () {
            return new \Tdwesten\StatamicBuilder\Stache\Stores\CollectionsStore(app('stache'));
        });

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
                Console\Export::class,
            ]);
        }

        parent::boot();
    }
}
