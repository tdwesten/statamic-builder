<?php

use Tdwesten\StatamicBuilder\Enums\BardButton;
use Tdwesten\StatamicBuilder\Enums\BardInlineOption;
use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Bard('title');
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

test('you can add multiple buttons', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Bard('title');
    $field->buttons([BardButton::Bold, BardButton::Italic]);

    expect($field->toArray()['field']['buttons'])->toBe(['bold', 'italic']);
});

test('you can add custom buttons as a string', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Bard('title');
    $field->buttons([BardButton::Bold, BardButton::Italic, 'custom_button']);

    expect($field->toArray()['field']['buttons'])->toBe(['bold', 'italic', 'custom_button']);
});

test('you can add a single button', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Bard('title');
    $field->buttons([BardButton::Bold]);

    expect($field->toArray()['field']['buttons'])->toBe(['bold']);
});

test('you can set the inline option', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Bard('title');
    $field->inline(BardInlineOption::True);

    expect($field->toArray()['field']['inline'])->toBe(true);
});

test('you can set inline to false', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Bard('title');
    $field->inline(BardInlineOption::False);

    expect($field->toArray()['field']['inline'])->toBe(false);
});

test('you can set inline to break (accordion)', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Bard('title');
    $field->inline(BardInlineOption::Break);

    expect($field->toArray()['field']['inline'])->toBe('accordion');
});
