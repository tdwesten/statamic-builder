<?php

use Tdwesten\StatamicBuilder\FieldTypes\Number;

it('can render to a array', function (): void {
    $field = Number::make('count')
        ->default(5)
        ->min(0)
        ->max(10)
        ->step(1)
        ->placeholder('Enter count')
        ->prepend('Qty:')
        ->append('pcs');

    expect($field->toArray()['field']['type'])->toBe('number');
    expect($field->toArray()['field']['default'])->toBe(5);
    expect($field->toArray()['field']['min'])->toBe(0);
    expect($field->toArray()['field']['max'])->toBe(10);
    expect($field->toArray()['field']['step'])->toBe(1);
    expect($field->toArray()['field']['placeholder'])->toBe('Enter count');
    expect($field->toArray()['field']['prepend'])->toBe('Qty:');
    expect($field->toArray()['field']['append'])->toBe('pcs');
});
