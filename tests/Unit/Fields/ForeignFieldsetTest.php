<?php

use Tdwesten\StatamicBuilder\FieldTypes\ForeignFieldset;

test('Foreign fieldset can be rendered', function () {
    $fieldset = ForeignFieldset::make('handle');
    $expected = [
        'import' => 'handle',
        'prefix' => null,
    ];

    expect($fieldset->toArray())->toBe($expected);
});

test('Foreign fieldset can be rendered with prefix', function () {
    $fieldset = ForeignFieldset::make('handle')->prefix('prefix_');
    $expected = [
        'import' => 'handle',
        'prefix' => 'prefix_',
    ];

    expect($fieldset->toArray())->toBe($expected);
});
