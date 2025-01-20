<?php

use Tdwesten\StatamicBuilder\Enums\MarkdownButtonOption;
use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Markdown('title');
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

test('it can render to a array with buttons', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Markdown('title');
    $field->buttons([
        MarkdownButtonOption::Bold,
        MarkdownButtonOption::Italic,
        MarkdownButtonOption::Link,
    ]);

    expect($field->toArray()['field']['buttons'])->toBe([
        MarkdownButtonOption::Bold->value,
        MarkdownButtonOption::Italic->value,
        MarkdownButtonOption::Link->value,
    ]);
});

test('it can render a array with buttons as string', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Markdown('title');
    $field->buttons([
        'bold',
        'italic',
        'link',
    ]);

    expect($field->toArray()['field']['buttons'])->toBe([
        MarkdownButtonOption::Bold->value,
        MarkdownButtonOption::Italic->value,
        MarkdownButtonOption::Link->value,
    ]);
});

test('Can set a asset container', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Markdown('title');
    $field->container('assets');

    expect($field->toArray()['field']['container'])->toBe('assets');
});

test('Can set a asset folder', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Markdown('title');
    $field->folder('folder');

    expect($field->toArray()['field']['folder'])->toBe('folder');
});

test('Can resetrict to a asset folder', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Markdown('title');
    $field->restrict('image');

    expect($field->toArray()['field']['restrict'])->toBe('image');
});

test('can set automatic line breaks', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Markdown('title');
    $field->automaticLineBreaks(true);

    expect($field->toArray()['field']['automatic_line_breaks'])->toBe(true);
});

test('can set automatic links', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Markdown('title');
    $field->automaticLinks(true);

    expect($field->toArray()['field']['automatic_links'])->toBe(true);
});

test('can set escape markup', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Markdown('title');
    $field->escapeMarkup(true);

    expect($field->toArray()['field']['escape_markup'])->toBe(true);
});

test('can set heading anchors', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Markdown('title');
    $field->headingAnchors(true);

    expect($field->toArray()['field']['heading_anchors'])->toBe(true);
});

test('Can set smartypants', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Markdown('title');
    $field->smartypants(true);

    expect($field->toArray()['field']['smartypants'])->toBe(true);
});

test('Can set default value', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Markdown('title');
    $field->default('default');

    expect($field->toArray()['field']['default'])->toBe('default');
});

test('Can enable table of contents', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Markdown('title');
    $field->tableOfContents(true);

    expect($field->toArray()['field']['table_of_contents'])->toBe(true);
});

test('Can define parser', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Markdown('title');
    $field->parser('markdown');

    expect($field->toArray()['field']['parser'])->toBe('markdown');
});
