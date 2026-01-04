<?php

use Tdwesten\StatamicBuilder\FieldTypes\ForeignField;

test('Foreign field can be rendered', function (): void {
    $field = ForeignField::make('handle', 'field_name');
    $expected = [
        'handle' => 'handle',
        'field' => 'field_name',
        'config' => [],
    ];

    expect($field->toArray())->toBe($expected);
});

test('Foreign field can be rendered with config', function (): void {
    $field = ForeignField::make('handle', 'field_name')->config(['display' => 'Custom Display']);
    $expected = [
        'handle' => 'handle',
        'field' => 'field_name',
        'config' => ['display' => 'Custom Display'],
    ];

    expect($field->toArray())->toBe($expected);
});
