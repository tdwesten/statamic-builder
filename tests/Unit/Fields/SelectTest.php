<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Select('title');
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

test('it can set taggable', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Select('title');
    $field->taggable();

    expect($field->toArray()['field']['taggable'])->toBe(true);
});

test('it can set push tags', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Select('title');
    $field->pushTags();

    expect($field->toArray()['field']['push_tags'])->toBe(true);
});

test('it can set placeholder', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Select('title');
    $field->placeholder('placeholder');

    expect($field->toArray()['field']['placeholder'])->toBe('placeholder');
});

test('it can set multiple', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Select('title');
    $field->multiple();

    expect($field->toArray()['field']['multiple'])->toBe(true);
});

test('it can set max items', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Select('title');
    $field->maxItems(5);

    expect($field->toArray()['field']['max_items'])->toBe(5);
});

test('it can set clearable', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Select('title');
    $field->clearable();

    expect($field->toArray()['field']['clearable'])->toBe(true);
});

test('it can set searchable', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Select('title');
    $field->searchable();

    expect($field->toArray()['field']['searchable'])->toBe(true);
});

test('it can set cast booleans', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Select('title');
    $field->castBooleans();

    expect($field->toArray()['field']['cast_booleans'])->toBe(true);
});
