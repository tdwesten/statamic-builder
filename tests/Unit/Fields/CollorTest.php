<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Collor('title');
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

test('you can set the allow any', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Collor('title');
    $field->allowAny(false);

    expect($field->toArray()['field']['allow_any'])->toBe(false);
});

test('you can set the swatches', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Collor('title');
    $field->swatches(['#000000', '#ffffff']);

    expect($field->toArray()['field']['swatches'])->toBe(['#000000', '#ffffff']);
});

test('you can set the default value', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Collor('title');
    $field->default('#000000');

    expect($field->toArray()['field']['default'])->toBe('#000000');
});
