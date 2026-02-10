<?php

namespace Tests\Feature\Http\Controllers;

use Statamic\Facades\AssetContainer;
use Statamic\Facades\User;
use Tdwesten\StatamicBuilder\BaseAssetContainer;
use Tests\Helpers\TestAssetContainerBlueprint;

test('it shows not editable view for builder defined asset container', function (): void {
    config(['app.key' => 'base64:mwP+tC6f059kYshh+2x46KOf4R66I65f2Dq9Xm5C7M8=']);
    config(['statamic.builder.asset_containers' => [
        TestAssetContainer::class,
    ]]);

    $container = AssetContainer::find('test_assets');

    $this->actingAs(User::make()->makeSuper()->save())
        ->get(cp_route('asset-containers.edit', $container))
        ->assertStatus(200)
        ->assertViewIs('statamic-builder::not-editable')
        ->assertViewHas('type', 'Asset Container');
});

test('it shows not editable view for builder defined asset container blueprint', function (): void {
    config(['app.key' => 'base64:mwP+tC6f059kYshh+2x46KOf4R66I65f2Dq9Xm5C7M8=']);
    config(['statamic.builder.blueprints' => [
        'assets' => [
            'test_assets' => TestAssetContainerBlueprint::class,
        ],
    ]]);

    $container = AssetContainer::make('test_assets')->save();

    $this->actingAs(User::make()->makeSuper()->save())
        ->get(cp_route('blueprints.asset-containers.edit', $container))
        ->assertStatus(200)
        ->assertViewIs('statamic-builder::not-editable')
        ->assertViewHas('type', 'Blueprint');
});

class TestAssetContainer extends BaseAssetContainer
{
    public static function handle(): string
    {
        return 'test_assets';
    }
}
