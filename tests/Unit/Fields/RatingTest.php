<?php

use Tdwesten\StatamicBuilder\FieldTypes\Rating;

it('can render to a array', function (): void {
    $field = Rating::make('score')
        ->default(3)
        ->min(1)
        ->max(5)
        ->step(0.5)
        ->clearable(true)
        ->color('yellow');

    expect($field->toArray()['field']['type'])->toBe('rating');
    expect($field->toArray()['field']['default'])->toBe(3);
    expect($field->toArray()['field']['min'])->toBe(1);
    expect($field->toArray()['field']['max'])->toBe(5);
    expect($field->toArray()['field']['step'])->toBe(0.5);
    expect($field->toArray()['field']['clearable'])->toBe(true);
    expect($field->toArray()['field']['color'])->toBe('yellow');
});
