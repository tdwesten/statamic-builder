<?php

use Tests\Helpers\TestCollection;

test('Has a title', function () {
    $collection = new TestCollection();

    expect($collection->title())->toBe(
        'Shows'
    );
});

test('Has a handle', function () {
    $collection = new TestCollection();

    expect($collection->handle())->toBe(
        'shows'
    );
});

test('The route can be set', function () {
    $collection = new TestCollection();

    $collection->route('/shows/{slug}');

    expect($collection->route())->toBe(
        '/shows/{slug}'
    );
});

test('The route can be null', function () {
    $collection = new TestCollection();

    $collection->route(null);

    expect($collection->route())->toBeNull();
});

test('Slugs can be generated', function () {
    $collection = new TestCollection();

    expect($collection->slugs())->toBeTrue();
});

test('The title format can be set', function () {
    $collection = new TestCollection();

    $collection->titleFormat('{title}');

    expect($collection->titleFormat())->toBe(
        '{title}'
    );
});

test('The title format can be null', function () {
    $collection = new TestCollection();

    $collection->titleFormat(null);

    expect($collection->titleFormat())->toBeNull();
});

test('The title format can be an array', function () {
    $collection = new TestCollection();

    $collection->titleFormat([
        'en' => 'En {title}',
        'es' => 'Es {title}',
    ]);

    expect($collection->titleFormat())->toBe(
        [
            'en' => 'En {title}',
            'es' => 'Es {title}',
        ]
    );
});

test('The mount can be set', function () {
    $collection = new TestCollection();

    $collection->mount('shows');

    expect($collection->mount())->toBe(
        'shows'
    );
});

test('The mount can be null', function () {
    $collection = new TestCollection();

    $collection->mount(null);

    expect($collection->mount())->toBeNull();
});

test('The collection can be dated', function () {
    $collection = new TestCollection();

    expect($collection->date())->toBeFalse();

    $collection->date(true);

    expect($collection->date())->toBeTrue();
});

test('The sites can be set', function () {
    $collection = new TestCollection();

    $collection->sites(['en', 'es']);

    expect($collection->sites())->toBe(
        ['en', 'es']
    );
});

test('The template can be set', function () {
    $collection = new TestCollection();

    $collection->template('show');

    expect($collection->template())->toBe(
        'show'
    );
});

test('The template can be null', function () {
    $collection = new TestCollection();

    $collection->template(null);

    expect($collection->template())->toBeNull();
});

test('The layout can be set', function () {
    $collection = new TestCollection();

    $collection->layout('show');

    expect($collection->layout())->toBe(
        'show'
    );
});

test('The layout can be null', function () {
    $collection = new TestCollection();

    $collection->layout(null);

    expect($collection->layout())->toBeNull();
});

test('The inject can be set', function () {
    $collection = new TestCollection();

    $collection->inject(['foo' => 'bar']);

    expect($collection->inject())->toBe(
        ['foo' => 'bar']
    );
});

test('The search index can be set', function () {
    $collection = new TestCollection();

    $collection->searchIndex('search_index_test');

    expect($collection->searchIndex())->toBe(
        'search_index_test'
    );
});

test('Revisions can be enabled', function () {
    $collection = new TestCollection();

    expect($collection->revisionsEnabled())->toBeFalse();

    $collection->revisionsEnabled(true);

    expect($collection->revisionsEnabled())->toBeTrue();
});

test('The default publish state can be set', function () {
    $collection = new TestCollection();

    $collection->defaultPublishState('published');

    expect($collection->defaultPublishState())->toBe(
        'published'
    );
});

test('The origin behavior can be set', function () {
    $collection = new TestCollection();

    $collection->originBehavior('unrelated');

    expect($collection->originBehavior())->toBe(
        'unrelated'
    );
});

test('The structure can be set', function () {
    $collection = new TestCollection();

    $collection->structure([
        'root' => true,
    ]);

    expect($collection->structure())->toBe(
        [
            'root' => true,
        ]
    );
});

test('The sort by can be set', function () {
    $collection = new TestCollection();

    $collection->sortBy('title');

    expect($collection->sortBy())->toBe(
        'title'
    );
});

test('The sort by can be null', function () {
    $collection = new TestCollection();

    $collection->sortBy(null);

    expect($collection->sortBy())->toBeNull();
});

test('The sort dir can be set', function () {
    $collection = new TestCollection();

    $collection->sortDir('asc');

    expect($collection->sortDir())->toBe(
        'asc'
    );
});

test('The sort dir can be null', function () {
    $collection = new TestCollection();

    $collection->sortDir(null);

    expect($collection->sortDir())->toBeNull();
});
