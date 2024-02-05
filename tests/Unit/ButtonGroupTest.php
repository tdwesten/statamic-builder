<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\ButtonGroup('title');
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

it('can render to a array with options', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\ButtonGroup('title');
    $field->options([
        'option1' => 'Option 1',
        'option2' => 'Option 2',
    ]);

    expect($field->toArray()['field']['options'])->toBe([
        'option1' => 'Option 1',
        'option2' => 'Option 2',
    ]);
});

it('can render to a array with default value', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\ButtonGroup('title');
    $field->default('option1');

    expect($field->toArray()['field']['default'])->toBe('option1');
});
