<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Statamic\Facades\AssetContainer;
use Tests\TestCase;

pest()->extend(TestCase::class);

beforeEach(function () {
    // Create a temporary directory for discovery
    if (! File::isDirectory(base_path('app/AssetContainers'))) {
        File::makeDirectory(base_path('app/AssetContainers'), 0755, true);
    }
});

afterEach(function () {
    // Clean up temporary directory
    if (File::isDirectory(base_path('app'))) {
        File::deleteDirectory(base_path('app'));
    }
});

test('it can auto discover asset containers', function () {
    // 1. Enable auto registration and set path
    Config::set('statamic.builder.auto_registration', true);
    Config::set('statamic.builder.auto_discovery.asset_containers', base_path('app/AssetContainers'));

    // 2. Create a dummy asset container class
    $classContent = <<<'PHP'
<?php

namespace App\AssetContainers;

use Tdwesten\StatamicBuilder\BaseAssetContainer;

class DiscoverableAssetContainer extends BaseAssetContainer
{
    public static function handle(): string
    {
        return 'discovered_assets';
    }
}
PHP;
    File::put(base_path('app/AssetContainers/DiscoverableAssetContainer.php'), $classContent);

    require_once base_path('app/AssetContainers/DiscoverableAssetContainer.php');

    // 3. Trigger discovery
    (new \Tdwesten\StatamicBuilder\Discovery)->discover();

    // 4. Verify it's in the config
    $registeredInStatamic = config('statamic.builder.asset_containers', []);

    expect($registeredInStatamic)->toContain('App\AssetContainers\DiscoverableAssetContainer');

    // 5. Verify Statamic can find it
    $container = AssetContainer::find('discovered_assets');
    expect($container)->not->toBeNull();
    expect($container->handle())->toBe('discovered_assets');
});
