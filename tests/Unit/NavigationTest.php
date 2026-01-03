<?php

use Tests\Helpers\TestNavigation;

test('Has a handle', function (): void {
    $nav = new TestNavigation;

    expect($nav->handle())->toBe('test_navigation');
});

test('Has a title', function (): void {
    $nav = new TestNavigation;

    expect($nav->title())->toBe('Test Navigation');
});

test('Has default collections', function (): void {
    $nav = new TestNavigation;

    expect($nav->collections())->toBe([]);
});

test('Has default sites', function (): void {
    $nav = new TestNavigation;

    expect($nav->sites())->toBeArray();
});

test('Has default expectsRoot', function (): void {
    $nav = new TestNavigation;

    expect($nav->expectsRoot())->toBeFalse();
});

test('Has default maxDepth', function (): void {
    $nav = new TestNavigation;

    expect($nav->maxDepth())->toBeNull();
});
