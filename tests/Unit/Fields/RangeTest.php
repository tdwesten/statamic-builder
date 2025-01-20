<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Range('title');
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

test('can have a min', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Range('title');
    $field->min(10);

    expect($field->toArray()['field']['min'])->toBe(10);
});

test('can have a max', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Range('title');
    $field->max(100);

    expect($field->toArray()['field']['max'])->toBe(100);
});

test('can have a step', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Range('title');
    $field->step(5);

    expect($field->toArray()['field']['step'])->toBe(5);
});

test('can have a prepend', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Range('title');
    $field->prepend('Prepend');

    expect($field->toArray()['field']['prepend'])->toBe('Prepend');
});

test('can have a append', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Range('title');
    $field->append('Append');

    expect($field->toArray()['field']['append'])->toBe('Append');
});
