<?php

use Tdwesten\StatamicBuilder\Enums\CodeModeOption;
use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Code('title');
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

test('you can set the mode', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Code('title');
    $field->mode(\Tdwesten\StatamicBuilder\Enums\CodeModeOption::CSS);

    expect($field->toArray()['field']['mode'])->toBe(CodeModeOption::CSS->value);
});

test('you can set the mode selectable', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Code('title');
    $field->modeSelectable(false);

    expect($field->toArray()['field']['mode_selectable'])->toBe(false);
});

test('you can set the indent type', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Code('title');
    $field->indentType(\Tdwesten\StatamicBuilder\Enums\CodeIndentTypeOption::Tabs);

    expect($field->toArray()['field']['indent_type'])->toBe(\Tdwesten\StatamicBuilder\Enums\CodeIndentTypeOption::Tabs->value);
});

test('you can set the indent size', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Code('title');
    $field->indentSize(2);

    expect($field->toArray()['field']['indent_size'])->toBe(2);
});

test('you can set the key map', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Code('title');
    $field->keyMap(\Tdwesten\StatamicBuilder\Enums\CodeKeyMapOption::Vim);

    expect($field->toArray()['field']['key_map'])->toBe(\Tdwesten\StatamicBuilder\Enums\CodeKeyMapOption::Vim->value);
});

test('you can set the line numbers', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Code('title');
    $field->lineNumbers();

    expect($field->toArray()['field']['line_numbers'])->toBe(true);
});

test('you can set the line wrapping', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Code('title');
    $field->lineWrapping();

    expect($field->toArray()['field']['line_wrapping'])->toBe(true);
});

test('you can set the rulers', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Code('title');
    $field->rulers([80, 120]);

    expect($field->toArray()['field']['rulers'])->toBe([80, 120]);
});
