<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Slug('title');
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

test('it can set from', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Slug('title');
    $field->from('from');

    expect($field->toArray()['field']['from'])->toBe('from');
});

test('it can set generate', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Slug('title');
    $field->generate();

    expect($field->toArray()['field']['generate'])->toBe(true);
});

test('it can show regenerate', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Slug('title');
    $field->showRegenerate();

    expect($field->toArray()['field']['show_regenerate'])->toBe(true);
});
