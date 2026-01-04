<?php

namespace Tests\Feature\Http\Controllers;

use Statamic\Facades\User;
use Tdwesten\StatamicBuilder\Repositories\NavigationRepository;
use Tests\Helpers\TestNavigation;
use Tests\Helpers\TestNavigationBlueprint;

test('it shows the not editable view when editing a builder defined navigation', function () {
    config(['app.key' => 'base64:m97Vl6m1xj5qVyXWjXWjXWjXWjXWjXWjXWjXWjXWjXU=']);
    config(['statamic.builder.navigations' => [TestNavigation::class]]);

    // Re-initialize the repository with the new config
    app()->singleton(\Statamic\Contracts\Structures\NavigationRepository::class, function () {
        return new NavigationRepository(app('stache'));
    });

    $user = User::make()->makeSuper()->save();

    $this->actingAs($user)
        ->get(cp_route('navigation.edit', 'test_navigation'))
        ->assertStatus(200)
        ->assertViewIs('statamic-builder::not-editable')
        ->assertViewHas('type', 'Navigation');
});

test('it shows the not editable view when editing a builder defined navigation blueprint', function () {
    config(['app.key' => 'base64:m97Vl6m1xj5qVyXWjXWjXWjXWjXWjXWjXWjXWjXWjXU=']);
    config(['statamic.builder.blueprints' => [
        'navigation' => [
            'test_navigation' => TestNavigationBlueprint::class,
        ],
    ]]);

    $user = User::make()->makeSuper()->save();

    $this->actingAs($user)
        ->get(cp_route('navigation.blueprint.edit', 'test_navigation'))
        ->assertStatus(200)
        ->assertViewIs('statamic-builder::not-editable')
        ->assertViewHas('type', 'Blueprint');
});

test('it shows the not editable view when editing a builder defined navigation with eloquent repository', function () {
    config(['app.key' => 'base64:m97Vl6m1xj5qVyXWjXWjXWjXWjXWjXWjXWjXWjXWjXU=']);
    config(['statamic.builder.navigations' => [TestNavigation::class]]);
    config(['statamic.eloquent-driver.navigations.driver' => 'eloquent']);

    // Re-initialize the repository with the new config
    app()->singleton(\Statamic\Contracts\Structures\NavigationRepository::class, function () {
        return new \Tdwesten\StatamicBuilder\Repositories\EloquentNavigationRepository(app('stache'));
    });

    $user = User::make()->makeSuper()->save();

    $this->actingAs($user)
        ->get(cp_route('navigation.edit', 'test_navigation'))
        ->assertStatus(200)
        ->assertViewIs('statamic-builder::not-editable')
        ->assertViewHas('type', 'Navigation');
});
