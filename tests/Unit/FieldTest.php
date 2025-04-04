<?php

use Tdwesten\StatamicBuilder\Enums\Icon;
use Tdwesten\StatamicBuilder\Enums\ListableOption;
use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
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

test('Can set a handle prefix', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->displayName('Name')
        ->prefix('county');

    expect($field->toArray()['handle'])->toBe('county.title');
});

test('Can set a display name', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->displayName('Name');

    expect($field->toArray()['field']['display'])->toBe('Name');
});

test('Can set instructions', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->instructions('Enter the title');

    expect($field->toArray()['field']['instructions'])->toBe('Enter the title');
});

test('Can set visibility', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->visibility(VisibilityOption::Hidden);

    expect($field->toArray()['field']['visibility'])->toBe('hidden');
});

test('Can set required', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->required();

    expect($field->toArray()['field']['validate'])->toBe(['required']);
});

test('Can set instructions position', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->instructionsPosition('below');

    expect($field->toArray()['field']['instructions_position'])->toBe('below');
});

test('Can set listable', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->listable(ListableOption::True);

    expect($field->toArray()['field']['listable'])->toBe(true);
});

test('Can set replicator preview', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->replicatorPreview(true);

    expect($field->toArray()['field']['replicator_preview'])->toBe(true);
});

test('Can set width', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->width(50);

    expect($field->toArray()['field']['width'])->toBe(50);
});

test('Can set antlers', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->antlers(true);

    expect($field->toArray()['field']['antlers'])->toBe(true);
});

test('Can set duplicate', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->duplicate(true);

    expect($field->toArray()['field']['duplicate'])->toBe(true);
});

test('Can set hide display', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->hideDisplay(true);

    expect($field->toArray()['field']['hide_display'])->toBe(true);
});

test('Can set localizable', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->localizable();

    expect($field->toArray()['field']['localizable'])->toBe(true);
});

test('Can set validation to sometimes', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field
        ->required()
        ->sometimes();

    expect($field->toArray()['field']['validate'])->toBe(['required', 'sometimes']);
});

test(' can set multiple validation rules', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->validate(['required', 'min:5']);

    expect($field->toArray()['field']['validate'])->toBe(['required', 'min:5']);
});

test('Can set a custom icon', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field->icon(Icon::AddonBoxesStack);

    expect($field->toArray()['field']['icon'])->toBe(Icon::AddonBoxesStack->value);
});

test('Can create a thirth-party field', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field
        ->type('tailwind-color')
        ->withAttributes([
            'swatches' => [
                'red' => 'Red',
                'blue' => 'Blue',
            ],
        ]);

    expect($field->toArray()['field']['type'])->toBe('tailwind-color');

    expect($field->toArray()['field']['swatches'])->toBe([
        'red' => 'Red',
        'blue' => 'Blue',
    ]);
});
