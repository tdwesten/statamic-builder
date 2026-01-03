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

test('Can set conditional logic with custom if', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field
        ->type('text')
        ->ifCustom('show_title === true && color === "red"');

    expect($field->toArray()['field']['if'])->toBe([
        'custom' => 'show_title === true && color === "red"',
    ]);
});

test('Can set conditional logic with custom if_any', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field
        ->type('text')
        ->ifAnyCustom('show_title === true || color === "red"');

    expect($field->toArray()['field']['if_any'])->toBe([
        'custom' => 'show_title === true || color === "red"',
    ]);
});

test('Can set conditional logic unless', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field
        ->type('text')
        ->unless('hide_title', OperatorOption::Equals, 'true');

    expect($field->toArray()['field']['unless'])->toBe([
        'hide_title' => 'equals true',
    ]);
});

test('Can set conditional logic unless with multiple conditions', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field
        ->type('text')
        ->unless('hide_title', OperatorOption::Equals, 'true')
        ->unless('show_content', OperatorOption::Not, 'false');

    expect($field->toArray()['field']['unless'])->toBe([
        'hide_title' => 'equals true',
        'show_content' => 'not false',
    ]);
});

test('Can set conditional logic with custom unless', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Field('title');
    $field
        ->type('text')
        ->unlessCustom('hide_title === true');

    expect($field->toArray()['field']['unless'])->toBe([
        'custom' => 'hide_title === true',
    ]);
});
