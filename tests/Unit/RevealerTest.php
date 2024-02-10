<?php

use Tdwesten\StatamicBuilder\Enums\RevealerModeUI;
use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Revealer('title');
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

it('can have a ui mode', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Revealer('title');
    $field->mode(RevealerModeUI::Button);

    expect($field->toArray()['field']['mode'])->toBe(RevealerModeUI::Button);
});

it('can have a input_label', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Revealer('title');
    $field->inputLabel('Enter the title');

    expect($field->toArray()['field']['input_label'])->toBe('Enter the title');
});
