<?php

use Tdwesten\StatamicBuilder\Enums\AutocompleteOption;
use Tdwesten\StatamicBuilder\Enums\InputTypeOption;
use Tdwesten\StatamicBuilder\Enums\VisibilityOption;
use Tdwesten\StatamicBuilder\FieldTypes\Text;

it('can render to a array', function (): void {

    Text::make('title')
        ->inputType(InputTypeOption::Email)
        ->displayName('Name')
        ->required()
        ->instructions('The name of the county')
        ->instructionsPosition('above')
        ->antlers(false)
        ->placeholder('Enter a title')
        ->default('Default value')
        ->characterLimit(100)
        ->autocomplete(AutocompleteOption::BdayDay)
        ->prepend('https://')
        ->append('.com')
        ->toArray();

    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Group('title');
    $field->displayName('Display Name')
        ->instructions('Enter the title')
        ->visibility(VisibilityOption::Hidden)
        ->required()
        ->instructionsPosition('below')
        ->listable()
        ->replicatorPreview(true)
        ->width(50);

    expect($field->toArray()['field']['display'])->toBe('Display Name');

    expect($field->toArray()['field']['instructions'])->toBe('Enter the title');

    expect($field->toArray()['field']['visibility'])->toBe('hidden');

    expect($field->toArray()['field']['validate'])->toBe(['required']);

    expect($field->toArray()['field']['instructions_position'])->toBe('below');

    expect($field->toArray()['field']['listable'])->toBe(true);

    expect($field->toArray()['field']['replicator_preview'])->toBe(true);

    expect($field->toArray()['field']['width'])->toBe(50);
});

test('Renders expected array data', function (): void {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->displayName('Name')
        ->required()
        ->instructions('The name of the county')
        ->instructionsPosition('above')
        ->antlers(false)
        ->listable();

    $expected = [
        'handle' => 'title',
        'field' => [
            'antlers' => false,
            'display' => 'Name',
            'duplicate' => true,
            'hide_display' => false,
            'input_type' => 'text',
            'instructions' => 'The name of the county',
            'instructions_position' => 'above',
            'listable' => true,
            'localizable' => false,
            'replicator_preview' => true,
            'required' => true,
            'type' => 'text',
            'validate' => [
                'required',
            ],
            'visibility' => 'visible',
        ],
    ];

    expect($text->toArray())->toBe($expected);
});

test('Can set input type to email', function (): void {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->inputType(InputTypeOption::Email);

    expect($text->toArray()['field']['input_type'])->toBe('email');
});

test('Can set input type to number', function (): void {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->inputType(InputTypeOption::Number);

    expect($text->toArray()['field']['input_type'])->toBe('number');
});

test('Can add a placeholder', function (): void {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->placeholder('Enter a title');

    expect($text->toArray()['field']['placeholder'])->toBe('Enter a title');
});

test('Can add a default value', function (): void {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->default('Default value');

    expect($text->toArray()['field']['default'])->toBe('Default value');
});

test('Can add a character limit', function (): void {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->characterLimit(100);

    expect($text->toArray()['field']['character_limit'])->toBe(100);
});

test('Can add autocomplete options', function (): void {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->autocomplete(AutocompleteOption::BdayDay);

    expect($text->toArray()['field']['autocomplete'])->toBe('bday-day');
});

test('Can add prepend text', function (): void {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->prepend('https://');

    expect($text->toArray()['field']['prepend'])->toBe('https://');
});

test('Can add append text', function (): void {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->append('.com');

    expect($text->toArray()['field']['append'])->toBe('.com');
});
