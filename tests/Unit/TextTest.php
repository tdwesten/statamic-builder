<?php

test('Renders expexted array data', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->displayName('Naam')
        ->required()
        ->validate('required')
        ->instructions('De naam van de school')
        ->instructionsPosition('above')
        ->antlers(false);

    $expected = [
        'handle' => 'title',
        'field' => [
            'display' => 'Naam',
            'type' => 'text',
            'validate' => [
                'required',
            ],
            'instructions' => 'De naam van de school',
            'instructions_position' => 'above',
            'required' => true,
            'visibility' => 'visible',
            'listable' => 'hidden',
            'replicator_preview' => true,
            'duplicate' => true,
            'antlers' => false,
            'hide_display' => false,
        ],
    ];

    expect($text->toArray())->toBe($expected);
});
