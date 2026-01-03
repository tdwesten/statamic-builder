<?php

namespace Tests\Unit;

use Tests\Helpers\TestAssetContainer;
use Tests\TestCase;

pest()->extend(TestCase::class);

test('Has a title', function (): void {
    $container = new TestAssetContainer;

    expect($container->title())->toBe(
        'Main Assets'
    );
});

test('Has a handle', function (): void {
    $container = new TestAssetContainer;

    expect($container->handle())->toBe(
        'main_assets'
    );
});

test('Has a disk', function (): void {
    $container = new TestAssetContainer;

    expect($container->disk())->toBe(
        'assets'
    );
});

test('Can be registered', function (): void {
    $container = new TestAssetContainer;
    $registered = $container->register();

    expect($registered)->toBeInstanceOf(\Statamic\Assets\AssetContainer::class);
    expect($registered->handle())->toBe('main_assets');
    expect($registered->title())->toBe('Main Assets');
    expect($registered->diskHandle())->toBe('assets');
});
