<?php

use Tdwesten\StatamicBuilder\Enums\AutocompleteOption;
use Tdwesten\StatamicBuilder\Enums\InputTypeOption;

test('Renders expected array data', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->displayName('Name')
        ->required()
        ->instructions('The name of the county')
        ->instructionsPosition('above')
        ->antlers(false);

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
            'listable' => 'hidden',
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

test('Can set input type to email', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->inputType(InputTypeOption::Email);

    expect($text->toArray()['field']['input_type'])->toBe('email');
});

test('Can set input type to number', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->inputType(InputTypeOption::Number);

    expect($text->toArray()['field']['input_type'])->toBe('number');
});

test('Can add a placeholder', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->placeholder('Enter a title');

    expect($text->toArray()['field']['placeholder'])->toBe('Enter a title');
});

test('Can add a default value', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->default('Default value');

    expect($text->toArray()['field']['default'])->toBe('Default value');
});

test('Can add a character limit', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->characterLimit(100);

    expect($text->toArray()['field']['character_limit'])->toBe(100);
});

test('Can add autocomplete options', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->autocomplete(AutocompleteOption::BdayDay);

    expect($text->toArray()['field']['autocomplete'])->toBe('bday-day');
});

test('Can add prepend text', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->prepend('https://');

    expect($text->toArray()['field']['prepend'])->toBe('https://');
});

test('Can add append text', function () {
    $text = new \Tdwesten\StatamicBuilder\FieldTypes\Text('title');
    $text->append('.com');

    expect($text->toArray()['field']['append'])->toBe('.com');
});
