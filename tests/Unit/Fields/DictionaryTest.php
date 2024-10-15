<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Dictionary('title');
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

it('type can be set', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Dictionary('title');
    $field->dictionaryType('countries');
    $field->dictionaryOptions(['region' => 'africa']);

    expect($field->toArray()['field']['dictionary']['type'])->toBe('countries');

    expect($field->toArray()['field']['dictionary']['region'])->toBe('africa');
});

it('can set additional dictionary options', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Dictionary('title');
    $field->dictionaryType('countries');

    $field->dictionaryOptions(['region' => 'africa', 'foo' => 'bar']);

    expect($field->toArray()['field']['dictionary']['type'])->toBe('countries');

    expect($field->toArray()['field']['dictionary']['region'])->toBe('africa');

    expect($field->toArray()['field']['dictionary']['foo'])->toBe('bar');
});

test('it can set placeholder', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Dictionary('title');
    $field->placeholder('placeholder');

    expect($field->toArray()['field']['placeholder'])->toBe('placeholder');
});

test('it can set max items', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Dictionary('title');
    $field->maxItems(5);

    expect($field->toArray()['field']['max_items'])->toBe(5);
});
