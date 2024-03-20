<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Toggle('title');
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

it('can have inline label', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Toggle('title');
    $field->inlineLabel('Inline Label');

    expect($field->toArray()['field']['inline_label'])->toBe('Inline Label');
});

it('can have inline label when true', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Toggle('title');
    $field->inlineLabelWhenTrue('Inline Label When True');

    expect($field->toArray()['field']['inline_label_when_true'])->toBe('Inline Label When True');
});
