<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Template('title');
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

test('it can hide partials', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Template('title');
    $field->hidePartials();

    expect($field->toArray()['field']['hide_partials'])->toBe(true);
});

test('it can set blueprint', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Template('title');
    $field->blueprint();

    expect($field->toArray()['field']['blueprint'])->toBe(true);
});

test('it can set folder', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Template('title');
    $field->folder('folder');

    expect($field->toArray()['field']['folder'])->toBe('folder');
});
