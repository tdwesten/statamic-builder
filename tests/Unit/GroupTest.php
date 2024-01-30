<?php

use Tdwesten\StatamicBuilder\FieldTypes\Group;
use Tdwesten\StatamicBuilder\FieldTypes\Text;

test('Renders a group to array', function () {

    $group = new Group('Call to action', [
        Text::make('label')
            ->displayName('Label')
            ->required()
            ->instructionsPosition('above')
            ->visibility('visible')
            ->listable()
            ->width(33),
    ]);

    $expected = [
        'title' => 'Call to action',
        'fields' => [
            [
                'handle' => 'label',
                'field' => [
                    'display' => 'Label',
                    'type' => 'text',
                    'validate' => [
                        'required',
                    ],
                    'instructions_position' => 'above',
                    'required' => true,
                    'visibility' => 'visible',
                    'listable' => true,
                    'replicator_preview' => true,
                    'duplicate' => true,
                    'antlers' => false,
                    'hide_display' => false,
                    'width' => 33,
                ],
            ],
        ],
    ];

    expect($group->toArray())->toBe($expected);
});
