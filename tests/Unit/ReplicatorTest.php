<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;
use Tdwesten\StatamicBuilder\FieldTypes\Set;
use Tdwesten\StatamicBuilder\FieldTypes\SetGroup;
use Tdwesten\StatamicBuilder\FieldTypes\Text;

it('can render to a array', function () {
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

it('can have sets', function () {
    $field = \Tdwesten\StatamicBuilder\FieldTypes\Replicator::make('replicator_veld', [
        SetGroup::make('nieuwe_set_groep', [
            Set::make('set_group_handel', [
                Text::make('text_veld')->displayName('Tekst Veld'),
            ])->icon('addon-boxes-stack')->instructions('set group instructies'),
        ])->displayName('Nieuwe Set Groep'),
    ])->displayName('Replicator Veld');

    expect($field->toArray()['field']['sets']['nieuwe_set_groep']['display'])->toBe('Nieuwe Set Groep');
});
