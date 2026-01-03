<?php

use Tdwesten\StatamicBuilder\FieldTypes\Hidden;

it('can render to a array', function (): void {
    $field = Hidden::make('hidden_field')->default('secret');

    expect($field->toArray()['field']['type'])->toBe('hidden');
    expect($field->toArray()['field']['default'])->toBe('secret');
});
