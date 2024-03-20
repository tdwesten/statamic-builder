<?php

use Tdwesten\StatamicBuilder\Enums\UIModeOption;
use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Structures('title');
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

test('it can set max_items', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Structures('title');
    $field->maxItems(5);

    expect($field->toArray()['field']['max_items'])->toBe(5);
});

test('it can set mode', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Structures('title');
    $field->mode(UIModeOption::Select);

    expect($field->toArray()['field']['mode'])->toBe('select');
});
