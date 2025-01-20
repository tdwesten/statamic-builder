<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Date('title');
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

it('can render to a array with mode', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Date('title');
    $field->mode(\Tdwesten\StatamicBuilder\Enums\DateModeOption::Range);

    expect($field->toArray()['field']['mode'])->toBe('range');
});

it('can render to a array with inline', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Date('title');
    $field->inline();

    expect($field->toArray()['field']['inline'])->toBe(true);
});

it('can render to a array with full width', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Date('title');
    $field->fullWidth();

    expect($field->toArray()['field']['full_width'])->toBe(true);
});

it('can render to a array with columns', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Date('title');
    $field->columns(2);

    expect($field->toArray()['field']['columns'])->toBe(2);
});

it('can render to a array with rows', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Date('title');
    $field->rows(2);

    expect($field->toArray()['field']['rows'])->toBe(2);
});

it('can render to a array with time enabled', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Date('title');
    $field->timeEnabled();

    expect($field->toArray()['field']['time_enabled'])->toBe(true);
});

it('can render to a array with time seconds enabled', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Date('title');
    $field->timeSecondsEnabled();

    expect($field->toArray()['field']['time_seconds_enabled'])->toBe(true);
});

it('can render to a array with earliest date', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Date('title');
    $field->earliestDate(new \Carbon\Carbon('2021-01-01'));

    expect($field->toArray()['field']['earliest_date'])->toBe('2021-01-01');
});

it('can render to a array with latest date', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Date('title');
    $field->latestDate(new \Carbon\Carbon('2021-01-01'));

    expect($field->toArray()['field']['latest_date'])->toBe('2021-01-01');
});

it('can render to a array with format', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Date('title');
    $field->format('Y-m-d');

    expect($field->toArray()['field']['format'])->toBe('Y-m-d');
});
