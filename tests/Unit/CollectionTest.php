<?php

use Tests\Helpers\MultisiteTestCollection;
use Tests\Helpers\TestCollection;

test('Has a title', function (): void {
    $collection = new TestCollection;

    expect($collection->title())->toBe(
        'Shows'
    );
});

test('Has a handle', function (): void {
    $collection = new TestCollection;

    expect($collection->handle())->toBe(
        'shows'
    );
});

test('Has a route', function (): void {
    $collection = new TestCollection;

    expect($collection->route())->toBe(
        '/shows/{slug}'
    );
});

test('Has multiple route for multisites', function (): void {
    $collection = new MultisiteTestCollection;

    expect($collection->route())->toBe(
        [
            'en' => '/shows/{slug}',
            'de' => '/shows/{slug}',
        ]
    );
});

test('Can have multiple sites', function (): void {
    $collection = new MultisiteTestCollection;

    expect($collection->sites())->toBe(
        ['en', 'de']
    );
});

test('Has slugs', function (): void {
    $collection = new TestCollection;

    expect($collection->slugs())->toBeTrue();
});

test('Has default values for optional methods', function (): void {
    $collection = new TestCollection;

    expect($collection->titleFormat())->toBeNull()
        ->and($collection->mount())->toBeNull()
        ->and($collection->date())->toBeFalse()
        ->and($collection->template())->toBeNull()
        ->and($collection->layout())->toBeNull()
        ->and($collection->inject())->toBe([])
        ->and($collection->searchIndex())->toBe('search_index')  // TestCollection overrides this
        ->and($collection->revisionsEnabled())->toBeFalse()
        ->and($collection->defaultPublishState())->toBeTrue()
        ->and($collection->originBehavior())->toBe('select')
        ->and($collection->structure())->toBe([  // TestCollection overrides this
            'root' => false,
            'slugs' => false,
            'max_depth' => null,
        ])
        ->and($collection->sortBy())->toBeNull()
        ->and($collection->sortDir())->toBeNull()
        ->and($collection->taxonomies())->toBe([])
        ->and($collection->propagate())->toBeNull()
        ->and($collection->previewTargets())->toBe([])
        ->and($collection->autosave())->toBeNull()
        ->and($collection->futureDateBehavior())->toBeNull()
        ->and($collection->pastDateBehavior())->toBeNull()
        ->and($collection->visible())->toBeTrue();
});
