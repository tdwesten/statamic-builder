<?php

use Statamic\Assets\AssetContainer as StatamicAssetContainer;
use Tdwesten\StatamicBuilder\Repositories\AssetContainerRepository;
use Tests\TestCase;

pest()->extend(TestCase::class);

test('::all includes builder-registered asset containers', function () {
    config(['statamic.builder.blueprints' => [
        'assets' => [
            'test_container' => \Tests\Helpers\TestBlueprint::class,
        ],
    ]]);

    $store = Mockery::mock(\Statamic\Stache\Stores\AssetContainerStore::class);
    $store->shouldReceive('paths')->andReturn(collect());
    $store->shouldReceive('getItems')->andReturn(collect([
        'test_container' => StatamicAssetContainer::make('test_container'),
    ]));

    $stache = Mockery::mock(\Statamic\Stache\Stache::class);
    $stache->shouldReceive('store')->with('asset-containers')->andReturn($store);

    $repository = new AssetContainerRepository($stache);
    $containers = $repository->all();

    expect($containers->has('test_container'))->toBeTrue();
});
