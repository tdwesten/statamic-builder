<?php

use Statamic\Assets\AssetContainer as StatamicAssetContainer;
use Tdwesten\StatamicBuilder\Repositories\AssetContainerRepository;
use Tests\Helpers\TestAssetContainer;

test('::all includes builder-registered asset containers', function (): void {
    config(['statamic.builder.asset_containers' => [
        TestAssetContainer::class,
    ]]);

    $store = Mockery::mock(\Statamic\Stache\Stores\AssetContainerStore::class);
    $store->shouldReceive('paths')->andReturn(collect());

    $stache = Mockery::mock(\Statamic\Stache\Stache::class);
    $stache->shouldReceive('store')->with('asset-containers')->andReturn($store);

    $repository = new AssetContainerRepository($stache);
    $containers = $repository->all();

    expect($containers->map->handle()->toArray())->toContain('main_assets');
});

test('can find by handle', function (): void {
    config(['statamic.builder.asset_containers' => [
        TestAssetContainer::class,
    ]]);

    $stache = Mockery::mock(\Statamic\Stache\Stache::class);
    $stache->shouldReceive('store')->with('asset-containers')->andReturn(Mockery::mock(\Statamic\Stache\Stores\AssetContainerStore::class));

    $repository = new AssetContainerRepository($stache);
    $container = $repository->findByHandle('main_assets');

    expect($container)->toBeInstanceOf(StatamicAssetContainer::class);
    expect($container->handle())->toBe('main_assets');
});
