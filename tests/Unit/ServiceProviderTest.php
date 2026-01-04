<?php

use Statamic\Contracts\Assets\AssetContainerRepository;
use Statamic\Contracts\Globals\GlobalRepository;
use Statamic\Contracts\Structures\NavigationRepository;
use Tdwesten\StatamicBuilder\Repositories\AssetContainerRepository as BuilderAssetContainerRepository;
use Tdwesten\StatamicBuilder\Repositories\GlobalRepository as BuilderGlobalRepository;
use Tdwesten\StatamicBuilder\Repositories\NavigationRepository as BuilderNavigationRepository;

test('it binds the navigation repository contract', function (): void {
    $repository = app(NavigationRepository::class);

    expect($repository)->toBeInstanceOf(BuilderNavigationRepository::class);
});

test('it binds the global repository contract', function (): void {
    $repository = app(GlobalRepository::class);

    expect($repository)->toBeInstanceOf(BuilderGlobalRepository::class);
});

test('it binds the asset container repository contract', function (): void {
    $repository = app(AssetContainerRepository::class);

    expect($repository)->toBeInstanceOf(BuilderAssetContainerRepository::class);
});

test('it binds the eloquent navigation repository when driver is eloquent', function (): void {
    config(['statamic.eloquent-driver.navigations.driver' => 'eloquent']);

    // Re-register the service provider or just the binding
    app()->singleton(NavigationRepository::class, function () {
        if (config('statamic.eloquent-driver.navigations.driver') === 'eloquent') {
            return new \Tdwesten\StatamicBuilder\Repositories\EloquentNavigationRepository(app('stache'));
        }

        return new \Tdwesten\StatamicBuilder\Repositories\NavigationRepository(app('stache'));
    });

    $repository = app(NavigationRepository::class);

    expect($repository)->toBeInstanceOf(\Tdwesten\StatamicBuilder\Repositories\EloquentNavigationRepository::class);
});

test('it binds the eloquent global repository when driver is eloquent', function (): void {
    config(['statamic.eloquent-driver.globals.driver' => 'eloquent']);

    // Re-register the service provider or just the binding
    app()->singleton(GlobalRepository::class, function () {
        if (config('statamic.eloquent-driver.globals.driver') === 'eloquent') {
            return new \Tdwesten\StatamicBuilder\Repositories\EloquentGlobalRepository(app('stache'));
        }

        return new \Tdwesten\StatamicBuilder\Repositories\GlobalRepository(app('stache'));
    });

    $repository = app(GlobalRepository::class);

    expect($repository)->toBeInstanceOf(\Tdwesten\StatamicBuilder\Repositories\EloquentGlobalRepository::class);
});
