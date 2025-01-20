<?php

use Tdwesten\StatamicBuilder\Enums\OperatorOption;

test('Can set conditional logic if', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field
        ->type('text')
        ->if('title', OperatorOption::Equals, 'red');

    expect($field->toArray()['field']['if'])->toBe([
        'title' => 'equals red',
    ]);
});

test('Can set conditional logic if with multiple conditions', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field
        ->type('text')
        ->if('title', OperatorOption::Equals, 'red')
        ->if('short_title', OperatorOption::IsIdentical, 'blue');

    expect($field->toArray()['field']['if'])->toBe([
        'title' => 'equals red',
        'short_title' => '=== blue',
    ]);
});

test('Can set conditional logic if any', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field
        ->type('text')
        ->ifAny('title', OperatorOption::Equals, 'red');

    expect($field->toArray()['field']['if_any'])->toBe([
        'title' => 'equals red',
    ]);
});
