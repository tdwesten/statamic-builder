<?php

it('can render to a array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Set('title', [
        new \Tdwesten\StatamicBuilder\FieldTypes\Text('title'),
    ]);
    $field->displayName('Display Name')
        ->instructions('Enter the title');

    expect($field->toArray()['display'])->toBe('Display Name');

    expect($field->toArray()['instructions'])->toBe('Enter the title');

    expect($field->toArray()['fields'][0]['field']['type'])->toBe('text');
});
