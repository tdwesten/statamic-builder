<?php

use Tdwesten\StatamicBuilder\Enums\AssetsUIModeOption;
use Tdwesten\StatamicBuilder\Enums\DynamicFolderOption;
use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->displayName('Display Name')
        ->instructions('Enter the title')
        ->visibility(VisibilityOption::Hidden)
        ->required()
        ->instructionsPosition('below')
        ->listable()
        ->container('container')
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

it('can set max files', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->maxFiles(5)->container('container');

    expect($field->toArray()['field']['max_files'])->toBe(5);
});

it('can set min files', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->minFiles(5)->container('container');

    expect($field->toArray()['field']['min_files'])->toBe(5);
});

it('can set mode', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->mode(AssetsUIModeOption::Grid)->container('container');

    expect($field->toArray()['field']['mode'])->toBe('grid');
});

it('can set container', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->container('container');

    expect($field->toArray()['field']['container'])->toBe('container');
});

it('can set folder', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->folder('folder')->container('container');

    expect($field->toArray()['field']['folder'])->toBe('folder');
});

it('can restrict', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->restrict()->container('container');

    expect($field->toArray()['field']['restrict'])->toBe(true);
});

it('can allow uploads', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->allowUploads()->container('container');

    expect($field->toArray()['field']['allow_uploads'])->toBe(true);
});

it('can show filename', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->showFilename()->container('container');

    expect($field->toArray()['field']['show_filename'])->toBe(true);
});

it('can show set alt', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->showSetAlt()->container('container');

    expect($field->toArray()['field']['show_set_alt'])->toBe(true);
});

it('can set query_scopes', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->queryScopes(['container1', 'container2'])->container('container');

    expect($field->toArray()['field']['query_scopes'])->toBe(['container1', 'container2']);
});

it('can set dynamic folder', function (): void {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->dynamic(DynamicFolderOption::Id)->container('container');

    expect($field->toArray()['field']['dynamic'])->toBe(DynamicFolderOption::Id->value);
});
