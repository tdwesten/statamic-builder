<?php

use Tdwesten\StatamicBuilder\Enums\AssetsUIModeOption;
use Tdwesten\StatamicBuilder\Enums\VisibilityOption;

it('can render to a array', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
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

it('can set max files', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->maxFiles(5);

    expect($field->toArray()['field']['max_files'])->toBe(5);
});

it('can set min files', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->minFiles(5);

    expect($field->toArray()['field']['min_files'])->toBe(5);
});

it('can set mode', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->mode(AssetsUIModeOption::Grid);

    expect($field->toArray()['field']['mode'])->toBe('grid');
});

it('can set container', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->container('container');

    expect($field->toArray()['field']['container'])->toBe('container');
});

it('can set folder', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->folder('folder');

    expect($field->toArray()['field']['folder'])->toBe('folder');
});

it('can restrict', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->restrict();

    expect($field->toArray()['field']['restrict'])->toBe(true);
});

it('can allow uploads', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->allowUploads();

    expect($field->toArray()['field']['allow_uploads'])->toBe(true);
});

it('can show filename', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->showFilename();

    expect($field->toArray()['field']['show_filename'])->toBe(true);
});

it('can show set alt', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->showSetAlt();

    expect($field->toArray()['field']['show_set_alt'])->toBe(true);
});

it('can set query_scopes', function () {
    $field = new \Tdwesten\StatamicBuilder\FieldTypes\Assets('title');
    $field->queryScopes(['container1', 'container2']);

    expect($field->toArray()['field']['query_scopes'])->toBe(['container1', 'container2']);
});
