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
