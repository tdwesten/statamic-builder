<?php

use Tdwesten\StatamicBuilder\FieldTypes\Money;

it('can render to a array', function (): void {
    $field = Money::make('price')->currency('USD')->default(100);

    expect($field->toArray()['field']['type'])->toBe('money');
    expect($field->toArray()['field']['currency'])->toBe('USD');
    expect($field->toArray()['field']['default'])->toBe(100);
});
