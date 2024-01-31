<?php

use Tdwesten\StatamicBuilder\FieldTypes\Section;
use Tdwesten\StatamicBuilder\FieldTypes\Text;

test('All fields are renderd', function () {
    $blueprint = new \Tdwesten\StatamicBuilder\Blueprint('article');

    $blueprint
        ->title('Article')
        ->hidden(true);

    expect($blueprint->toArray())->toBe([
        'title' => 'Article',
        'hide' => true,
        'tabs' => [],
    ]);
});

it('can be set to hidden', function () {
    $blueprint = new \Tdwesten\StatamicBuilder\Blueprint('article');

    $blueprint->hidden(true);

    expect($blueprint->toArray())->toBe([
        'title' => null,
        'hide' => true,
        'tabs' => [],
    ]);
});

test('Tabs are renderd', function () {
    $blueprint = new \Tdwesten\StatamicBuilder\Blueprint('school');
    $blueprint
        ->title('School')
        ->addTab('main', [], 'Main')
        ->addTab('meta', [], 'Meta');

    $expected = [
        'title' => 'School',
        'hide' => false,
        'tabs' => [
            'main' => [
                'display' => 'Main',
                'fields' => [],
            ],
            'meta' => [
                'display' => 'Meta',
                'fields' => [],
            ],
        ],
    ];

    expect($blueprint->toArray())->toBe($expected);
});

test('Fields are renderd', function () {
    $blueprint = new \Tdwesten\StatamicBuilder\Blueprint('school');
    $blueprint
        ->title('School')
        ->addTab('main', [
            Text::make('name')->displayName('Name'),
        ], 'Main')
        ->addTab('meta', [
            Text::make('description')->displayName('Description'),
        ], 'Meta');

    $expected = [
        'title' => 'School',
        'hide' => false,
        'tabs' => [
            'main' => [
                'display' => 'Main',
                'fields' => [
                    [
                        'name' => [
                            'handle' => 'name',
                            'field' => [
                                'antlers' => false,
                                'display' => 'Name',
                                'duplicate' => true,
                                'hide_display' => false,
                                'input_type' => 'text',
                                'instructions_position' => 'above',
                                'listable' => 'hidden',
                                'replicator_preview' => true,
                                'type' => 'text',
                                'visibility' => 'visible',
                            ],
                        ],
                    ],
                ],
            ],
            'meta' => [
                'display' => 'Meta',
                'fields' => [
                    [
                        'description' => [
                            'handle' => 'description',
                            'field' => [
                                'antlers' => false,
                                'display' => 'Description',
                                'duplicate' => true,
                                'hide_display' => false,
                                'input_type' => 'text',
                                'instructions_position' => 'above',
                                'listable' => 'hidden',
                                'replicator_preview' => true,
                                'type' => 'text',
                                'visibility' => 'visible',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    expect($blueprint->toArray())->toBe($expected);
});

test('Fields in sections are renderd', function () {
    $blueprint = new \Tdwesten\StatamicBuilder\Blueprint('school');
    $blueprint
        ->title('School')
        ->addTab('main', [
            Section::make('main', [
                Text::make('name')->displayName('Name'),
            ]),
        ], 'Main')
        ->addTab('meta', [
            Section::make('meta', [
                Text::make('description')->displayName('Description'),
            ]),
        ], 'Meta');

    ray($blueprint->toArray());

    $expected = [
        'title' => 'School',
        'hide' => false,
        'tabs' => [
            'main' => [
                'display' => 'Main',
                'sections' => [
                    [
                        'display' => 'main',
                        'fields' => [
                            [
                                'handle' => 'name',
                                'field' => [
                                    'antlers' => false,
                                    'display' => 'Name',
                                    'duplicate' => true,
                                    'hide_display' => false,
                                    'input_type' => 'text',
                                    'instructions_position' => 'above',
                                    'listable' => 'hidden',
                                    'replicator_preview' => true,
                                    'type' => 'text',
                                    'visibility' => 'visible',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'meta' => [
                'display' => 'Meta',
                'sections' => [
                    [
                        'display' => 'meta',
                        'fields' => [
                            [
                                'handle' => 'description',
                                'field' => [
                                    'antlers' => false,
                                    'display' => 'Description',
                                    'duplicate' => true,
                                    'hide_display' => false,
                                    'input_type' => 'text',
                                    'instructions_position' => 'above',
                                    'listable' => 'hidden',
                                    'replicator_preview' => true,
                                    'type' => 'text',
                                    'visibility' => 'visible',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    expect($blueprint->toArray())->toBe($expected);
});
