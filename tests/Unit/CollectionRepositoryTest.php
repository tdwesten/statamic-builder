<?php

use Statamic\Facades\Collection;
use Tests\Helpers\TestCollection;

beforeEach(function (): void {
    config(['statamic.builder.collections' => []]);
});

test('::find does not throw when no result is found', function (): void {
    Collection::find('id-that-does-not-exist');
})->throwsNoExceptions();

test('::find returns null for nonexistent handles', function (): void {
    $nullset = Collection::find('id-that-does-not-exist');

    expect($nullset)->toBeNull();
});

test('::findByHandle finds builder-registered collection', function (): void {
    config(['statamic.builder.collections' => [TestCollection::class]]);

    // Re-initialize the repository with the new config
    app()->singleton(\Statamic\Stache\Repositories\CollectionRepository::class, function () {
        return new \Tdwesten\StatamicBuilder\Repositories\CollectionRepository(app('stache'));
    });

    $collection = Collection::findByHandle('shows');

    expect($collection)->not()->toBeNull();
    expect($collection->handle())->toBe('shows');
    expect($collection->title())->toBe('Shows');
});

test('::all includes builder-registered collections', function (): void {
    config(['statamic.builder.collections' => [TestCollection::class]]);

    // Re-initialize the repository with the new config
    app()->singleton(\Statamic\Stache\Repositories\CollectionRepository::class, function () {
        return new \Tdwesten\StatamicBuilder\Repositories\CollectionRepository(app('stache'));
    });

    $collections = Collection::all();

    expect($collections->has('shows'))->toBeTrue();
});
