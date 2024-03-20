<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Video('title');
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

it('can have a default', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Video('title');
    $field->default('https://www.youtube.com/watch?v=12345');

    expect($field->toArray()['field']['default'])->toBe('https://www.youtube.com/watch?v=12345');
});

it('can have a placeholder', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Video('title');
    $field->placeholder('https://www.youtube.com/watch?v=12345');

    expect($field->toArray()['field']['placeholder'])->toBe('https://www.youtube.com/watch?v=12345');

});
