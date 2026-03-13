<?php

namespace Tdwesten\StatamicBuilder;

use Illuminate\Http\Request;
use Statamic\Contracts\Assets\AssetContainerRepository;
use Statamic\Contracts\Structures\NavigationRepository;
use Statamic\Facades\Blueprint;
use Statamic\Fields\BlueprintRepository;
use Statamic\Fields\FieldsetRepository;
use Statamic\Http\Controllers\CP\Globals\GlobalsBlueprintController;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Sites\Sites;
use Statamic\Stache\Stores\CollectionsStore;
use Statamic\Stache\Stores\GlobalsStore;
use Statamic\Stache\Stores\NavigationStore;
use Statamic\Stache\Stores\TaxonomiesStore;
use Tdwesten\StatamicBuilder\Http\Controllers\AssetContainerBlueprintController;
use Tdwesten\StatamicBuilder\Http\Controllers\AssetContainersController;
use Tdwesten\StatamicBuilder\Http\Controllers\CollectionBlueprintsController;
use Tdwesten\StatamicBuilder\Http\Controllers\CollectionsController;
use Tdwesten\StatamicBuilder\Http\Controllers\FieldsetController;
use Tdwesten\StatamicBuilder\Http\Controllers\GlobalsBlueprintsController;
use Tdwesten\StatamicBuilder\Http\Controllers\GlobalsController;
use Tdwesten\StatamicBuilder\Http\Controllers\NavigationBlueprintController;
use Tdwesten\StatamicBuilder\Http\Controllers\NavigationController;
use Tdwesten\StatamicBuilder\Http\Controllers\TaxonomiesController;
use Tdwesten\StatamicBuilder\Http\Controllers\TaxonomyBlueprintsController;
use Tdwesten\StatamicBuilder\Http\Controllers\UserBlueprintController;
use Tdwesten\StatamicBuilder\Repositories\CollectionRepository;
use Tdwesten\StatamicBuilder\Repositories\EloquentGlobalRepository;
use Tdwesten\StatamicBuilder\Repositories\EloquentNavigationRepository;
use Tdwesten\StatamicBuilder\Repositories\GlobalRepository;
use Tdwesten\StatamicBuilder\Repositories\TaxonomyRepository;

class ServiceProvider extends AddonServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/builder.php', 'statamic.builder');

        (new Discovery)->discover();

        $this->bindRepositories();

        $this->registerControllers();

        $this->bindStores();

        $this->bindSites();
    }

    protected function bindSites()
    {
        $this->app->bind(Sites::class, fn () => new \Tdwesten\StatamicBuilder\Sites\Sites);
    }

    protected function registerControllers()
    {
        $this->app->bind(\Statamic\Http\Controllers\CP\Collections\CollectionBlueprintsController::class, function () {
            return new CollectionBlueprintsController;
        });

        $this->app->bind(GlobalsBlueprintController::class, function () {
            return new GlobalsBlueprintsController;
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Taxonomies\TaxonomyBlueprintsController::class, function () {
            return new TaxonomyBlueprintsController;
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Navigation\NavigationBlueprintController::class, function () {
            return new NavigationBlueprintController;
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Navigation\NavigationController::class, function ($app) {
            return new NavigationController($app->make(Request::class));
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Assets\AssetContainerBlueprintController::class, function () {
            return new AssetContainerBlueprintController(
                app('request')
            );
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Assets\AssetContainersController::class, function () {
            return new AssetContainersController(
                app('request')
            );
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Users\UserBlueprintController::class, function () {
            return new UserBlueprintController;
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Collections\CollectionsController::class, function ($app) {
            return new CollectionsController(
                $app->make(Request::class),
                $app->make(CollectionRepository::class)
            );
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Taxonomies\TaxonomiesController::class, function ($app) {
            return new TaxonomiesController(
                $app->make(Request::class),
                $app->make(TaxonomyRepository::class)
            );
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Globals\GlobalsController::class, function ($app) {
            return new GlobalsController(
                $app->make(Request::class),
                $app->make(GlobalRepository::class)
            );
        });

        $this->app->bind(\Statamic\Http\Controllers\CP\Fields\FieldsetController::class, function ($app) {
            return new FieldsetController(
                $app->make(Request::class),
                $app->make(Repositories\FieldsetRepository::class)
            );
        });
    }

    protected function bindStores()
    {
        $this->app->singleton(CollectionsStore::class, function () {
            return new Stache\Stores\CollectionsStore(app('stache'));
        });

        $this->app->singleton(TaxonomiesStore::class, function () {
            return new Stache\Stores\TaxonomiesStore(app('stache'));
        });

        $this->app->singleton(GlobalsStore::class, function () {
            return new Stache\Stores\GlobalsStore(app('stache'));
        });

        $this->app->singleton(NavigationStore::class, function () {
            return new Stache\Stores\NavigationStore(app('stache'));
        });
    }

    protected function bindRepositories()
    {
        $this->app->singleton(AssetContainerRepository::class, function () {
            return new Repositories\AssetContainerRepository(app('stache'));
        });

        $this->app->singleton(\Statamic\Contracts\Globals\GlobalRepository::class, function () {
            if (config('statamic.eloquent-driver.globals.driver') === 'eloquent') {
                return new EloquentGlobalRepository(app('stache'));
            }

            return new GlobalRepository(app('stache'));
        });

        $this->app->singleton(FieldsetRepository::class, function () {
            return (new Repositories\FieldsetRepository)
                ->setDirectory(resource_path('fieldsets'));
        });

        $this->app->singleton(NavigationRepository::class, function () {
            if (config('statamic.eloquent-driver.navigations.driver') === 'eloquent') {
                return new EloquentNavigationRepository(app('stache'));
            }

            return new Repositories\NavigationRepository(app('stache'));
        });

        $this->app->singleton(\Statamic\Contracts\Entries\CollectionRepository::class, function () {
            return new CollectionRepository(app('stache'));
        });

        $this->app->singleton(\Statamic\Contracts\Taxonomies\TaxonomyRepository::class, function () {
            return new TaxonomyRepository(app('stache'));
        });

        $this->app->singleton(BlueprintRepository::class, function () {
            return (new Repositories\BlueprintRepository)
                ->setDirectory(resource_path('blueprints'))
                ->setFallback('default', function () {
                    return Blueprint::makeFromFields([
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
                Console\MakeAssetContainerCommand::class,
            ]);
        }

        parent::boot();
    }
}
