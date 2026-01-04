<?php

use Statamic\Facades\Collection;
use Tests\Helpers\TestCollection;

test('registered collections can be found by handle', function (): void {
    config(['statamic.builder.collections' => [
        TestCollection::class,
    ]]);

    $collection = Collection::find('shows');

    expect($collection)->not->toBeNull();
    expect($collection->handle())->toBe('shows');
});

test('register method properly configures collection with all settings', function (): void {
    $collectionClass = new TestCollection;
    $collection = $collectionClass->register();

    expect($collection)->not->toBeNull()
        ->and($collection->handle())->toBe('shows')
        ->and($collection->title())->toBe('Shows')
        ->and($collection->routes()->toArray())->toHaveKey('default')
        ->and($collection->requiresSlugs())->toBeTrue()
        ->and($collection->dated())->toBeFalse()
        ->and($collection->revisionsEnabled())->toBeFalse()
        ->and($collection->defaultPublishState())->toBeTrue();
});
