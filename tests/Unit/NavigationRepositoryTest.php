<?php

use Statamic\Contracts\Structures\NavigationRepository;
use Statamic\Facades\Nav;
use Tdwesten\StatamicBuilder\Repositories\NavigationRepository as BuilderNavigationRepository;
use Tests\Helpers\TestNavigation;

beforeEach(function (): void {
    config(['statamic.builder.navigations' => []]);
});

test('::find does not throw when no result is found', function (): void {
    Nav::find('id-that-does-not-exist');
})->throwsNoExceptions();

test('::find returns null for nonexistent handles', function (): void {
    $nullnav = Nav::find('id-that-does-not-exist');

    expect($nullnav)->toBeNull();
});

test('::findByHandle finds builder-registered navigation', function (): void {
    config(['statamic.builder.navigations' => [TestNavigation::class]]);

    // Re-initialize the repository with the new config
    app()->singleton(NavigationRepository::class, function () {
        return new BuilderNavigationRepository(app('stache'));
    });

    $navigation = Nav::findByHandle('test_navigation');

    expect($navigation)->not()->toBeNull();
    expect($navigation->handle())->toBe('test_navigation');
    expect($navigation->title())->toBe('Test Navigation');
});

test('::all includes builder-registered navigations', function (): void {
    config(['statamic.builder.navigations' => [TestNavigation::class]]);

    // Re-initialize the repository with the new config
    app()->singleton(NavigationRepository::class, function () {
        return new BuilderNavigationRepository(app('stache'));
    });

    $navigations = Nav::all();

    expect($navigations->has('test_navigation'))->toBeTrue();
});
