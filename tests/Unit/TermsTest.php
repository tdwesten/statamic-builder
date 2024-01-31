<?php

test('Terms field renders', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Terms('counties');
    $text->displayName('Counties')
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

    expect($text->toArray())->toBe($expected);
});

test('You can set max items', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Terms('counties');
    $text->displayName('Counties')
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

    expect($text->toArray())->toBe($expected);
});

test('Terms field renders with multiple taxonomies', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Terms('counties');
    $text->displayName('Counties')
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

    expect($text->toArray())->toBe($expected);
});

test('Terms field renders with multiple taxonomies and mode', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Terms('counties');
    $text->displayName('Counties')
        ->required()
        ->instructions('The counties of the school')
        ->taxonomies(['counties', 'cities'])
        ->mode('select');

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

    expect($text->toArray())->toBe($expected);
});

test('Terms field renders with create option', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Terms('counties');
    $text->displayName('Counties')
        ->required()
        ->instructions('The counties of the school')
        ->taxonomies(['counties', 'cities'])
        ->mode('select')
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

    expect($text->toArray())->toBe($expected);
});
