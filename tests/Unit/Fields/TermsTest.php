<?php

use Tdwesten\StatamicBuilder\Enums\UIModeOption;

test('Terms field renders', function (): void {
    $terms = new \Tdwesten\StatamicBuilder\FieldTypes\Terms('counties');
    $terms->displayName('Counties')
        ->required()
        ->instructions('The counties of the school')
        ->taxonomies(['counties']);

    $expected = [
        'handle' => 'counties',
        'field' => [
            'antlers' => false,
            'create' => true,
            'display' => 'Counties',
            'duplicate' => true,
            'hide_display' => false,
            'instructions' => 'The counties of the school',
            'instructions_position' => 'above',
            'listable' => 'hidden',
            'localizable' => false,
            'mode' => 'default',
            'replicator_preview' => true,
            'required' => true,
            'taxonomies' => [
                'counties',
            ],
            'type' => 'terms',
            'validate' => [
                'required',
            ],
            'visibility' => 'visible',
        ],
    ];

    expect($terms->toArray())->toBe($expected);
});

test('You can set max items', function (): void {
    $terms = new \Tdwesten\StatamicBuilder\FieldTypes\Terms('counties');
    $terms->displayName('Counties')
        ->required()
        ->instructions('The counties of the school')
        ->taxonomies(['counties'])
        ->maxItems(5);

    $expected = [
        'handle' => 'counties',
        'field' => [
            'antlers' => false,
            'create' => true,
            'display' => 'Counties',
            'duplicate' => true,
            'hide_display' => false,
            'instructions' => 'The counties of the school',
            'instructions_position' => 'above',
            'listable' => 'hidden',
            'localizable' => false,
            'max_items' => 5,
            'mode' => 'default',
            'replicator_preview' => true,
            'required' => true,
            'taxonomies' => [
                'counties',
            ],
            'type' => 'terms',
            'validate' => [
                'required',
            ],
            'visibility' => 'visible',
        ],
    ];

    expect($terms->toArray())->toBe($expected);
});

test('Terms field renders with multiple taxonomies', function (): void {
    $terms = new \Tdwesten\StatamicBuilder\FieldTypes\Terms('counties');
    $terms->displayName('Counties')
        ->required()
        ->instructions('The counties of the school')
        ->taxonomies(['counties', 'cities']);

    $expected = [
        'handle' => 'counties',
        'field' => [
            'antlers' => false,
            'create' => true,
            'display' => 'Counties',
            'duplicate' => true,
            'hide_display' => false,
            'instructions' => 'The counties of the school',
            'instructions_position' => 'above',
            'listable' => 'hidden',
            'localizable' => false,
            'mode' => 'default',
            'replicator_preview' => true,
            'required' => true,
            'taxonomies' => [
                'counties',
                'cities',
            ],
            'type' => 'terms',
            'validate' => [
                'required',
            ],
            'visibility' => 'visible',
        ],
    ];

    expect($terms->toArray())->toBe($expected);
});

test('Terms field renders with multiple taxonomies and mode', function (): void {
    $terms = new \Tdwesten\StatamicBuilder\FieldTypes\Terms('counties');
    $terms->displayName('Counties')
        ->required()
        ->instructions('The counties of the school')
        ->taxonomies(['counties', 'cities'])
        ->mode(UIModeOption::Select);

    $expected = [
        'handle' => 'counties',
        'field' => [
            'antlers' => false,
            'create' => true,
            'display' => 'Counties',
            'duplicate' => true,
            'hide_display' => false,
            'instructions' => 'The counties of the school',
            'instructions_position' => 'above',
            'listable' => 'hidden',
            'localizable' => false,
            'mode' => 'select',
            'replicator_preview' => true,
            'required' => true,
            'taxonomies' => [
                'counties',
                'cities',
            ],
            'type' => 'terms',
            'validate' => [
                'required',
            ],
            'visibility' => 'visible',
        ],
    ];

    expect($terms->toArray())->toBe($expected);
});

test('Terms field renders with create option', function (): void {
    $terms = new \Tdwesten\StatamicBuilder\FieldTypes\Terms('counties');
    $terms->displayName('Counties')
        ->required()
        ->instructions('The counties of the school')
        ->taxonomies(['counties', 'cities'])
        ->mode(UIModeOption::Select)
        ->create(false);

    $expected = [
        'handle' => 'counties',
        'field' => [
            'antlers' => false,
            'create' => false,
            'display' => 'Counties',
            'duplicate' => true,
            'hide_display' => false,
            'instructions' => 'The counties of the school',
            'instructions_position' => 'above',
            'listable' => 'hidden',
            'localizable' => false,
            'mode' => 'select',
            'replicator_preview' => true,
            'required' => true,
            'taxonomies' => [
                'counties',
                'cities',
            ],
            'type' => 'terms',
            'validate' => [
                'required',
            ],
            'visibility' => 'visible',
        ],
    ];

    expect($terms->toArray())->toBe($expected);
});

test('can have query scopes', function (): void {
    $terms = new \Tdwesten\StatamicBuilder\FieldTypes\Terms('counties');

    $terms->queryScopes([
        'featured', 'published',
    ]);

    expect($terms->toArray()['field']['query_scopes'])->toBe([
        'featured', 'published',
    ]);
});
