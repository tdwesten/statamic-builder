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
