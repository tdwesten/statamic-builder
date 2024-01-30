<?php

use Tdwesten\StatamicBuilder\FieldTypes\Section;
use Tdwesten\StatamicBuilder\FieldTypes\Text;

test('toArray ', function () {
    $blueprint = new \Tdwesten\StatamicBuilder\Blueprint('school');
    $blueprint
        ->title('School')
        ->addTab('main', [
            Section::make('Main section', [
                Text::make('title')
                    ->required()
                    ->instructionsPosition('above')
                    ->visibility('visible')
                    ->listable()
                    ->replicatorPreview(true),
            ]),
        ]);

    $expected = [
        'title' => 'School',
        'tabs' => [
            [
                'name' => 'main',
                'fields' => [
                    [
                        'display' => 'Main section',
                        'fields' => [
                            [
                                'handle' => 'title',
                                'field' => [
                                    'display' => 'title',
                                    'type' => 'text',
                                    'validate' => [
                                        'required',
                                    ],
                                    'instructions' => null,
                                    'instructions_position' => 'above',
                                    'required' => true,
                                    'visibility' => 'visible',
                                    'listable' => true,
                                    'replicator_preview' => true,
                                    'duplicate' => true,
                                    'antlers' => false,
                                    'hide_display' => false,
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
