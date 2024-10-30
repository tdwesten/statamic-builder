<?php

use Tests\Helpers\TestSite;

test('Has a name', function () {
    $site = new TestSite();

    expect($site->name())->toBe(
        'Blog'
    );
});

test('Has a handle', function () {
    $site = new TestSite();

    expect($site->handle())->toBe(
        'blog'
    );
});

test('Has a url', function () {
    $site = new TestSite();

    expect($site->url())->toBe(
        'http://blog.test'
    );
});

test('Has a locale', function () {
    $site = new TestSite();

    expect($site->locale())->toBe(
        'en_US'
    );
});

test('Has extra attributes', function () {
    $site = new TestSite();

    expect($site->attributes())->toBe([
        'extra' => 'attributes'
    ]);
});