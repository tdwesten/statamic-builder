<?php

use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Link('title');
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

it('can render to a array with collections', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Link('title');
    $field->collections(['blog', 'news'])
        ->container('assets');

    expect($field->toArray()['field']['collections'])->toBe(['blog', 'news']);
});

it('can render to a array with container', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Link('title');
    $field->container('assets');

    expect($field->toArray()['field']['container'])->toBe('assets');
});
