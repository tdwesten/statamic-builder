<?php

use Tests\Helpers\TestGlobalSet;

test('Has a handle', function (): void {
    $global = new TestGlobalSet;

    expect($global->handle())->toBe('test_global');
});

test('Has a title', function (): void {
    $global = new TestGlobalSet;

    expect($global->title())->toBe('Test Global Set');
});

test('Has sites', function (): void {
    $global = new TestGlobalSet;

    expect($global->sites())->toBe(['default']);
});

test('Register method creates global set with proper configuration', function (): void {
    $globalClass = new TestGlobalSet;
    $global = $globalClass->register();

    expect($global)->not->toBeNull()
        ->and($global->handle())->toBe('test_global')
        ->and($global->title())->toBe('Test Global Set')
        ->and($global->existsIn('default'))->toBeTrue();
});
