<?php

use Tdwesten\StatamicBuilder\Enums\UIModeOption;
use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Entries('title');
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

test('it can render to a array with max items', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Entries('title');
    $field->maxItems(5);

    expect($field->toArray()['field']['max_items'])->toBe(5);
});

test('it can render to a array with mode', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Entries('title');
    $field->mode(UIModeOption::Select);

    expect($field->toArray()['field']['mode'])->toBe(UIModeOption::Select->value);
});

test('it can render to a array with collections', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Entries('title');
    $field->collections(['blog', 'news']);

    expect($field->toArray()['field']['collections'])->toBe(['blog', 'news']);
});

test('it can render to a array with search index', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Entries('title');
    $field->searchIndex('title');

    expect($field->toArray()['field']['search_index'])->toBe('title');
});

test('it can render the queryScopes to the array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Entries('title');
    $field->queryScopes(['scope1', 'scope2']);

    expect($field->toArray()['field']['query_scopes'])->toBe(['scope1', 'scope2']);
});
