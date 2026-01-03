<?php

use Statamic\Facades\AssetContainer;
use Tdwesten\StatamicBuilder\BaseAssetContainer;
use Tests\TestCase;

pest()->extend(TestCase::class);

class IntegrationTestAssetContainer extends BaseAssetContainer
{
    public static function handle(): string
    {
        return 'integration_assets';
    }
}

test('registered asset containers are found by the repository', function () {
    config(['statamic.builder.asset_containers' => [
        IntegrationTestAssetContainer::class,
    ]]);

    $container = AssetContainer::find('integration_assets');

    expect($container)->not->toBeNull();
    expect($container->handle())->toBe('integration_assets');
});

test('all includes registered asset containers', function () {
    config(['statamic.builder.asset_containers' => [
        IntegrationTestAssetContainer::class,
    ]]);

    $containers = AssetContainer::all();

    expect($containers->map->handle()->toArray())->toContain('integration_assets');
});
