<?php

use Statamic\Facades\GlobalSet;
use Tests\Helpers\TestGlobalSet;

beforeEach(function (): void {
    config(['statamic.builder.globals' => []]);
});

test('::find does not throw when no result is found', function (): void {
    GlobalSet::find('id-that-does-not-exist');
})->throwsNoExceptions();

test('::find returns null for nonexistent handles', function (): void {
    $nullset = GlobalSet::find('id-that-does-not-exist');

    expect($nullset)->toBeNull();
});

test('::findByHandle finds builder-registered global', function (): void {
    config(['statamic.builder.globals' => [TestGlobalSet::class]]);

    // Re-initialize the repository with the new config
    app()->singleton(\Statamic\Contracts\Globals\GlobalRepository::class, function () {
        return new \Tdwesten\StatamicBuilder\Repositories\GlobalRepository(app('stache'));
    });

    $globalSet = GlobalSet::findByHandle('test_global');

    expect($globalSet)->not()->toBeNull();
    expect($globalSet->handle())->toBe('test_global');
    expect($globalSet->title())->toBe('Test Global Set');
});

test('::all includes builder-registered globals', function (): void {
    config(['statamic.builder.globals' => [TestGlobalSet::class]]);

    // Re-initialize the repository with the new config
    app()->singleton(\Statamic\Contracts\Globals\GlobalRepository::class, function () {
        return new \Tdwesten\StatamicBuilder\Repositories\GlobalRepository(app('stache'));
    });

    $globals = GlobalSet::all();

    expect($globals->has('test_global'))->toBeTrue();
});

test('::all includes globals from blueprints', function (): void {
    config(['statamic.builder.blueprints.globals' => [
        'blueprint_global' => \Tests\Helpers\TestBlueprint::class,
    ]]);

    // Re-initialize the repository with the new config
    app()->singleton(\Statamic\Contracts\Globals\GlobalRepository::class, function () {
        return new \Tdwesten\StatamicBuilder\Repositories\GlobalRepository(app('stache'));
    });

    $globals = GlobalSet::all();

    expect($globals->has('blueprint_global'))->toBeTrue();
});
