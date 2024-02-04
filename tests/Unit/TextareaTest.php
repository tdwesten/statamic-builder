<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Textarea('title');
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

it('can have a character limit', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Textarea('title');
    $field->characterLimit(100);

    expect($field->toArray()['field']['character_limit'])->toBe(100);
});

it('can have a placeholder', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Textarea('title');
    $field->placeholder('Enter the title');

    expect($field->toArray()['field']['placeholder'])->toBe('Enter the title');
});

it('can have a default value', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Textarea('title');
    $field->default('Default value');

    expect($field->toArray()['field']['default'])->toBe('Default value');
});
