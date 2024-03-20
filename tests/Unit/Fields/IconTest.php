<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Icon('title');
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

test('it can render to a array with directory', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Icon('title');
    $field->directory('vendor/package/icons');

    expect($field->toArray()['field']['directory'])->toBe('vendor/package/icons');
});

test('it can render to a array with folder', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Icon('title');
    $field->folder('folder');

    expect($field->toArray()['field']['folder'])->toBe('folder');
});

test('it can render to a array with default', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Icon('title');
    $field->default('default');

    expect($field->toArray()['field']['default'])->toBe('default');
});
