<?php

use Tdwesten\StatamicBuilder\FieldTypes\Group;
use Tdwesten\StatamicBuilder\FieldTypes\Section;
use Tdwesten\StatamicBuilder\FieldTypes\Text;
use Tests\Helpers\TestFieldset;

it('can be instantiated', function () {
    $fieldset = new \Tdwesten\StatamicBuilder\Fieldset('test');
    expect($fieldset)->toBeInstanceOf(\Tdwesten\StatamicBuilder\Fieldset::class);
});

it('can be registered', function () {
    $fieldset = new \Tdwesten\StatamicBuilder\Fieldset('test');
    $fields = $fieldset->toArray();

    expect($fields)->toBeArray();
});

it('can be converted to an array', function () {
    $fieldset = TestFieldset::make('test');
    $fields = $fieldset->toArray();

    expect($fields)->toBeArray();
});

test('A fieldset can be used in a blueprint', function () {
    $blueprint = new \Tdwesten\StatamicBuilder\Blueprint('school');
    $blueprint
        ->title('School')
        ->addTab('main', [
            Section::make('main', [
                Text::make('name')->displayName('Name'),
                TestFieldset::make('test'),
            ]),
        ], 'Main');

    $fields = $blueprint->toArray();

    expect($fields)->toBeArray();

    expect($fields['tabs']['main']['sections'][0]['fields'][1]['import'])->toBe('test_fieldset');
});

test('A fieldset can be used in group', function () {
    $blueprint = new \Tdwesten\StatamicBuilder\Blueprint('school');
    $blueprint
        ->title('School')
        ->addTab('main', [
            Section::make('main', [
                Text::make('name')->displayName('Name'),
                Group::make('test', [
                    TestFieldset::make('test'),
                ]),
            ]),
        ], 'Main');

    $fields = $blueprint->toArray();

    expect($fields)->toBeArray();

    expect($fields['tabs']['main']['sections'][0]['fields'][1]['field']['fields'][0]['import'])->toBe('test_fieldset');
});

test('A fieldset can be used in a fieldset', function () {
    $blueprint = new \Tdwesten\StatamicBuilder\Blueprint('school');
    $blueprint
        ->addTab('main', [
            Section::make('main', [
                Text::make('name')->displayName('Name'),
                TestFieldset::make('test'),
            ]),
        ]);

    $fields = $blueprint->toArray();

    expect($fields)->toBeArray();

    expect($fields['tabs']['main']['sections'][0]['fields'][1]['import'])->toBe('test_fieldset');
});
