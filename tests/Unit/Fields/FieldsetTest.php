<?php

use Tdwesten\StatamicBuilder\FieldTypes\Group;
use Tdwesten\StatamicBuilder\FieldTypes\Section;
use Tdwesten\StatamicBuilder\FieldTypes\Tab;
use Tdwesten\StatamicBuilder\FieldTypes\Text;
use Tests\Helpers\EmptyTestBlueprint;
use Tests\Helpers\TestFieldset;

it('can be instantiated', function (): void {
    $fieldset = new \Tdwesten\StatamicBuilder\Fieldset('test');
    expect($fieldset)->toBeInstanceOf(\Tdwesten\StatamicBuilder\Fieldset::class);
});

it('can be registered', function (): void {
    $fieldset = new \Tdwesten\StatamicBuilder\Fieldset('test');
    $fields = $fieldset->toArray();

    expect($fields)->toBeArray();
});

test('getPrefix returns null when no prefix is set', function (): void {
    $fieldset = TestFieldset::make();

    expect($fieldset->getPrefix())->toBeNull();
});

test('getPrefix returns prefix when set in constructor', function (): void {
    $fieldset = TestFieldset::make('my_prefix');

    expect($fieldset->getPrefix())->toBe('my_prefix');
});

test('prefix method sets prefix and returns instance for chaining', function (): void {
    $fieldset = TestFieldset::make();
    $result = $fieldset->prefix('new_prefix');

    expect($result)->toBe($fieldset)
        ->and($fieldset->getPrefix())->toBe('new_prefix');
});

test('getFields returns collection of fields with prefix applied', function (): void {
    $fieldset = TestFieldset::make('test_prefix');
    $fields = $fieldset->getFields();

    expect($fields)->toBeInstanceOf(\Illuminate\Support\Collection::class)
        ->and($fields->count())->toBeGreaterThan(0);
});

it('can be converted to an array', function (): void {
    $fieldset = TestFieldset::make('test');
    $fields = $fieldset->toArray();

    expect($fields)->toBeArray();
});

test('A fieldset can be used in a blueprint', function (): void {
    $blueprint = EmptyTestBlueprint::make('school');
    $blueprint
        ->title('School')
        ->addTab(Tab::make('main', [
            Section::make('main', [
                Text::make('name')->displayName('Name'),
                TestFieldset::make('test'),
            ]),
        ])
        );

    $fields = $blueprint->toArray();

    expect($fields)->toBeArray();

    expect($fields['tabs']['main']['sections'][0]['fields'][1]['import'])->toBe('test_fieldset');
});

test('A fieldset can be used in group', function (): void {
    $blueprint = EmptyTestBlueprint::make('school');
    $blueprint
        ->title('School')
        ->addTab(Tab::make('main', [
            Section::make('main', [
                Text::make('name')->displayName('Name'),
                Group::make('test', [
                    TestFieldset::make('test'),
                ]),
            ])])
        );

    $fields = $blueprint->toArray();

    expect($fields)->toBeArray();

    expect($fields['tabs']['main']['sections'][0]['fields'][1]['field']['fields'][0]['import'])->toBe('test_fieldset');
});

test('A fieldset can be used in a fieldset', function (): void {
    $blueprint = EmptyTestBlueprint::make('school');
    $blueprint
        ->addTab(Tab::make('main', [
            Section::make('main', [
                Text::make('name')->displayName('Name'),
                TestFieldset::make('test'),
            ]),
        ])
        );

    $fields = $blueprint->toArray();

    expect($fields)->toBeArray();

    expect($fields['tabs']['main']['sections'][0]['fields'][1]['import'])->toBe('test_fieldset');
});
