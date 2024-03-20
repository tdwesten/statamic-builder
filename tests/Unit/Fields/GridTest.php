<?php

use Tdwesten\StatamicBuilder\Enums\GridModeOption;
use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Grid('title');
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

test('it can render to a array with reorderable', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Grid('title');
    $field->reorderable(false);

    expect($field->toArray()['field']['reorderable'])->toBe(false);
});

test('it can render to a array with add row', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Grid('title');
    $field->addRow('Add Row');

    expect($field->toArray()['field']['add_row'])->toBe('Add Row');
});

test('it can render to a array with max rows', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Grid('title');
    $field->maxRows(5);

    expect($field->toArray()['field']['max_rows'])->toBe(5);
});

test('it can render to a array with min rows', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Grid('title');
    $field->minRows(5);

    expect($field->toArray()['field']['min_rows'])->toBe(5);
});

test('it can render to a array with mode', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Grid('title');
    $field->mode(GridModeOption::Table);

    expect($field->toArray()['field']['mode'])->toBe(\Tdwesten\StatamicBuilder\Enums\GridModeOption::Table->value);
});
