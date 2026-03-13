<?php

use Tdwesten\StatamicBuilder\FieldTypes\Section;
use Tdwesten\StatamicBuilder\FieldTypes\Text;

test('Section can be rendered', function (): void {
    $section = Section::make('General', [
        Text::make('title')->displayName('Title'),
    ]);

    $array = $section->toArray();

    expect($array['display'])->toBe('General');
    expect($array['fields'][0]['handle'])->toBe('title');
});

test('Section can render instructions', function (): void {
    $section = Section::make('General', [
        Text::make('title')->displayName('Title'),
    ])->instructions('Helpful section copy');

    expect($section->toArray()['instructions'])->toBe('Helpful section copy');
});

test('Section can be collapsible', function (): void {
    $section = Section::make('General', [
        Text::make('title')->displayName('Title'),
    ])->collapsible();

    expect($section->toArray()['collapsible'])->toBeTrue();
    expect($section->toArray()['collapsed'])->toBeFalse();
});

test('Section can be collapsed when collapsible', function (): void {
    $section = Section::make('General', [
        Text::make('title')->displayName('Title'),
    ])->collapsible()->collapsed();

    expect($section->toArray()['collapsible'])->toBeTrue();
    expect($section->toArray()['collapsed'])->toBeTrue();
});

test('Section does not render collapsed without collapsible', function (): void {
    $section = Section::make('General', [
        Text::make('title')->displayName('Title'),
    ])->collapsed();

    expect($section->toArray())->not->toHaveKey('collapsed');
    expect($section->toArray())->not->toHaveKey('collapsible');
});
