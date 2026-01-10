<?php

namespace Tests\Feature;

use Statamic\Facades\Entry;
use Tdwesten\StatamicBuilder\BaseCollection;

class TestCollectionWithMount extends BaseCollection
{
    public static function handle(): string
    {
        return 'test_collection';
    }

    public function mount(): ?string
    {
        return 'mount-page';
    }
}

test('it resolves mount handle to UUID when eloquent driver is used', function () {
    // 1. Mock the config to use eloquent driver
    config(['statamic.eloquent-driver.entries.driver' => 'eloquent']);

    // 2. Mock an entry with the given handle (slug)
    $entry = \Mockery::mock(\Statamic\Contracts\Entries\Entry::class);
    $entry->shouldReceive('id')->andReturn('uuid-1234');

    Entry::shouldReceive('findByUri')
        ->with('mount-page')
        ->andReturn($entry);

    $collection = new TestCollectionWithMount;
    $resolvedMount = $collection->resolveMount();

    expect($resolvedMount)->toBe('uuid-1234');
});

test('it uses handle for mount when stache driver is used', function () {
    // 1. Mock the config to use stache driver (default)
    config(['statamic.eloquent-driver.entries.driver' => 'file']);

    $collection = new TestCollectionWithMount;
    $resolvedMount = $collection->resolveMount();

    expect($resolvedMount)->toBe('mount-page');
});

test('it uses handle for mount when exporting', function () {
    // 1. Mock the config to use eloquent driver
    config(['statamic.eloquent-driver.entries.driver' => 'eloquent']);

    \Tdwesten\StatamicBuilder\BaseCollection::$isExporting = true;

    $collection = new TestCollectionWithMount;
    $resolvedMount = $collection->resolveMount();

    expect($resolvedMount)->toBe('mount-page');

    \Tdwesten\StatamicBuilder\BaseCollection::$isExporting = false;
});
