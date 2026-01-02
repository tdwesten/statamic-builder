<?php

namespace Tdwesten\StatamicBuilder;

use Illuminate\Http\Request;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/builder.php', 'builder');

        $this->bindRepositories();

        $this->registerControllers();

        $this->bindStores();

        $this->bindSites();
    }

    protected function bindSites()
    {
        $this->app->bind(\Statamic\Sites\Sites::class, fn () => new \Tdwesten\StatamicBuilder\Sites\Sites);
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

        $this->app->bind(\Statamic\Http\Controllers\CP\Navigation\NavigationController::class, function ($app) {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\NavigationController($app->make(Request::class));
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Assets\AssetContainerBlueprintController::class, function () {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\AssetContainerBlueprintController(
                app('request')
            );
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Users\UserBlueprintController::class, function () {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\UserBlueprintController;
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Collections\CollectionsController::class, function ($app) {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\CollectionsController(
                $app->make(Request::class),
                $app->make(\Tdwesten\StatamicBuilder\Repositories\CollectionRepository::class)
            );
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Taxonomies\TaxonomiesController::class, function ($app) {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\TaxonomiesController(
                $app->make(Request::class),
                $app->make(\Tdwesten\StatamicBuilder\Repositories\TaxonomyRepository::class)
            );
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Globals\GlobalsController::class, function ($app) {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\GlobalsController(
                $app->make(Request::class),
                $app->make(\Tdwesten\StatamicBuilder\Repositories\GlobalRepository::class)
            );
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Fields\FieldsetController::class, function ($app) {
            return new \Tdwesten\StatamicBuilder\Http\Controllers\FieldsetController(
                $app->make(Request::class),
                $app->make(\Tdwesten\StatamicBuilder\Repositories\FieldsetRepository::class)
            );
        });
    }

    protected function bindStores()
    {
        $this->app->singleton(\Statamic\Stache\Stores\CollectionsStore::class, function () {
            return new \Tdwesten\StatamicBuilder\Stache\Stores\CollectionsStore(app('stache'));
        });

        $this->app->singleton(\Statamic\Stache\Stores\TaxonomiesStore::class, function () {
            return new \Tdwesten\StatamicBuilder\Stache\Stores\TaxonomiesStore(app('stache'));
        });

        $this->app->singleton(\Statamic\Stache\Stores\GlobalsStore::class, function () {
            return new \Tdwesten\StatamicBuilder\Stache\Stores\GlobalsStore(app('stache'));
        });
    }

    protected function bindRepositories()
    {
        $this->app->singleton(\Statamic\Stache\Repositories\AssetContainerRepository::class, function () {
            return new \Tdwesten\StatamicBuilder\Repositories\AssetContainerRepository(app('stache'));
        });

        $this->app->singleton(\Statamic\Stache\Repositories\GlobalRepository::class, function () {
            if (config('statamic.eloquent-driver.globals.driver') === 'eloquent') {
                return new \Tdwesten\StatamicBuilder\Repositories\EloquentGlobalRepository;
            }

            return new \Tdwesten\StatamicBuilder\Repositories\GlobalRepository(app('stache'));
        });

        $this->app->singleton(\Statamic\Fields\FieldsetRepository::class, function () {
            return (new \Tdwesten\StatamicBuilder\Repositories\FieldsetRepository)
                ->setDirectory(resource_path('fieldsets'));
        });

        $this->app->singleton(\Statamic\Stache\Repositories\NavigationRepository::class, function () {
            if (config('statamic.eloquent-driver.navigations.driver') === 'eloquent') {
                return new \Tdwesten\StatamicBuilder\Repositories\EloquentNavigationRepository(app('stache'));
            }

            return new \Tdwesten\StatamicBuilder\Repositories\NavigationRepository(app('stache'));
        });

        $this->app->singleton(\Statamic\Contracts\Entries\CollectionRepository::class, function () {
            return new \Tdwesten\StatamicBuilder\Repositories\CollectionRepository(app('stache'));
        });

        $this->app->singleton(\Statamic\Contracts\Taxonomies\TaxonomyRepository::class, function () {
            return new \Tdwesten\StatamicBuilder\Repositories\TaxonomyRepository(app('stache'));
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
                Console\MakeTaxonomyCommand::class,
                Console\MakeGlobalSetCommand::class,
                Console\Export::class,
                Console\MakeNavigationCommand::class,
                Console\MakeSiteCommand::class,
            ]);
        }

        parent::boot();
    }
}
