<?php

use Tests\Helpers\TestSite;

test('Has a name', function (): void {
    $site = new TestSite;

    expect($site->name())->toBe(
        'Blog'
    );
});

test('Has a handle', function (): void {
    $site = new TestSite;

    expect($site->handle())->toBe(
        'blog'
    );
});

test('Has a url', function (): void {
    $site = new TestSite;

    expect($site->url())->toBe(
        'http://blog.test'
    );
});

test('Has a locale', function (): void {
    $site = new TestSite;

    expect($site->locale())->toBe(
        'en_US'
    );
});

test('Has extra attributes', function (): void {
    $site = new TestSite;

    expect($site->attributes())->toBe([
        'extra' => 'attributes',
    ]);
});

test('Can convert to array', function (): void {
    $site = new TestSite;

    $array = $site->toArray();

    expect($array)->toBeArray()
        ->and($array['name'])->toBe('Blog')
        ->and($array['url'])->toBe('http://blog.test')
        ->and($array['locale'])->toBe('en_US')
        ->and($array['attributes'])->toBe([
            'extra' => 'attributes',
        ]);
});
