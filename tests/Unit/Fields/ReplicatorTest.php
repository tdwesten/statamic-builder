<?php

use Tdwesten\StatamicBuilder\Enums\Icon;
use Tdwesten\StatamicBuilder\Enums\VisibilityOption;
use Tdwesten\StatamicBuilder\FieldTypes\Replicator;
use Tdwesten\StatamicBuilder\FieldTypes\Set;
use Tdwesten\StatamicBuilder\FieldTypes\SetGroup;
use Tdwesten\StatamicBuilder\FieldTypes\Text;

it('can render to a array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Replicator('title');
    $field->displayName('Display Name')
        ->instructions('Enter the title')
        ->visibility(VisibilityOption::Hidden)
        ->required()
        ->instructionsPosition('below')
        ->listable()
        ->replicatorPreview(true)
        ->width(50);

    expect($field->toArray()['field']['display'])->toBe('Display Name');

    expect($field->toArray()['field']['instructions'])->toBe('Enter the title');

    expect($field->toArray()['field']['visibility'])->toBe('hidden');

    expect($field->toArray()['field']['validate'])->toBe(['required']);

    expect($field->toArray()['field']['instructions_position'])->toBe('below');

    expect($field->toArray()['field']['listable'])->toBe(true);

    expect($field->toArray()['field']['replicator_preview'])->toBe(true);

    expect($field->toArray()['field']['width'])->toBe(50);
});

it('can have sets', function (): void {
    $field = \Tdwesten\StatamicBuilder\FieldTypes\Replicator::make('replicator_veld', [
        SetGroup::make('nieuwe_set_groep', [
            Set::make('set_group_handel', [
                Text::make('text_veld')->displayName('Tekst Veld'),
            ])->icon(Icon::AddonBoxesStack)->instructions('set group instructies'),
        ])->displayName('Nieuwe Set Groep'),
    ])->displayName('Replicator Veld');

    expect($field->toArray()['field']['sets']['nieuwe_set_groep']['display'])->toBe('Nieuwe Set Groep');
});

it('can render the same output', function (): void {
    $output = [
        'handle' => 'replicator_veld',
        'field' => [
            'antlers' => false,
            'collapse' => false,
            'display' => 'Replicator Veld',
            'duplicate' => true,
            'fullscreen' => true,
            'hide_display' => false,
            'instructions_position' => 'above',
            'listable' => 'hidden',
            'localizable' => false,
            'previews' => true,
            'replicator_preview' => true,
            'sets' => [
                'nieuwe_set_groep' => [
                    'display' => 'Nieuwe Set Groep',
                    'instructions' => null,
                    'icon' => null,
                    'sets' => [
                        'set_group_handel' => [
                            'display' => 'Set group',
                            'fields' => [
                                [
                                    'handle' => 'text_veld',
                                    'field' => [
                                        'antlers' => false,
                                        'display' => 'Text Veld',
                                        'duplicate' => true,
                                        'hide_display' => false,
                                        'input_type' => 'text',
                                        'instructions_position' => 'above',
                                        'listable' => 'hidden',
                                        'localizable' => false,
                                        'replicator_preview' => true,
                                        'type' => 'text',
                                        'visibility' => 'visible',
                                    ],
                                ],
                            ],
                            'icon' => null,
                            'instructions' => 'set group instructies',
                        ],
                    ],
                ],
            ],
            'type' => 'replicator',
            'visibility' => 'visible',
        ],
    ];

    $field = Replicator::make('replicator_veld', [
        SetGroup::make('nieuwe_set_groep', [
            Set::make('set_group_handel', [
                Text::make('text_veld')->displayName('Text Veld'),
            ])
                ->instructions('set group instructies')
                ->displayName('Set group'),
        ])->displayName('Nieuwe Set Groep'),

    ])->displayName('Replicator Veld')
        ->previews(true)
        ->fullscreen(true)
        ->hideDisplay(false);

    expect($field->toArray())->toBe($output);
});
