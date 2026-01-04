<?php

use Statamic\Facades\GlobalSet;
use Tests\Helpers\TestGlobalSet;

beforeEach(function (): void {
    config(['statamic.builder.globals' => [TestGlobalSet::class]]);

    // Re-initialize the repository with the new config
    app()->singleton(\Statamic\Contracts\Globals\GlobalRepository::class, function () {
        return new \Tdwesten\StatamicBuilder\Repositories\GlobalRepository(app('stache'));
    });
});

test('it can save global variables', function (): void {
    $globalSet = GlobalSet::findByHandle('test_global');
    expect($globalSet)->not()->toBeNull();

    $localization = $globalSet->in('default');
    expect($localization)->not()->toBeNull();

    $localization->set('test_field', 'test_value');
    $localization->save();

    $globalSet = GlobalSet::findByHandle('test_global');
    $localization = $globalSet->in('default');

    expect($localization->get('test_field'))->toBe('test_value');
});

test('it can save global variables for blueprint-based globals', function (): void {
    config(['statamic.builder.blueprints.globals' => [
        'blueprint_global' => \Tests\Helpers\TestBlueprint::class,
    ]]);

    // Re-initialize the repository with the new config
    app()->singleton(\Statamic\Contracts\Globals\GlobalRepository::class, function () {
        return new \Tdwesten\StatamicBuilder\Repositories\GlobalRepository(app('stache'));
    });

    $globalSet = GlobalSet::findByHandle('blueprint_global');
    // Note: findByHandle in GlobalRepository only looks in $this->globals (classes)
    // or parent::findByHandle (stache/file).
    // If it's ONLY a blueprint, it might not be found by findByHandle unless it's already saved to disk.
    // BUT GlobalSet::all() should include it.

    $all = GlobalSet::all();
    expect($all->has('blueprint_global'))->toBeTrue();

    $globalSet = $all->get('blueprint_global');
    expect($globalSet)->not()->toBeNull();

    $localization = $globalSet->in('default');
    expect($localization)->not()->toBeNull();

    $localization->set('test_field', 'blueprint_value');
    $localization->save();

    // Now it should also be findable by handle because it's on disk (parent::findByHandle)
    $globalSet = GlobalSet::findByHandle('blueprint_global');
    expect($globalSet)->not()->toBeNull();

    $localization = $globalSet->in('default');
    expect($localization->get('test_field'))->toBe('blueprint_value');
});
