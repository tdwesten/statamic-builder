<?php

use Tdwesten\StatamicBuilder\FieldTypes\Password;

it('can render to a array', function (): void {
    $field = Password::make('pass')->placeholder('Secret');

    expect($field->toArray()['field']['type'])->toBe('password');
    expect($field->toArray()['field']['placeholder'])->toBe('Secret');
});
