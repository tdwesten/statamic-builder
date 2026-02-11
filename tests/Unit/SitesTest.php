<?php

use Illuminate\Support\Facades\Cache;
use Tdwesten\StatamicBuilder\Sites\Sites;
use Tests\Helpers\TestSite;

beforeEach(function (): void {
    Cache::forget('statamic.builder.sites');
});

test('getSavedSites returns builder configured sites', function (): void {
    config(['statamic.builder.sites' => [
        TestSite::class,
    ]]);

    $sites = new Sites(config('statamic.sites'));
    $result = $sites->all();

    expect($result)->toHaveCount(1)
        ->and($result->first()->handle())->toBe('blog');
});

test('getSavedSites returns parent result when config is null', function (): void {
    config(['statamic.builder.sites' => null]);

    $sites = new Sites(config('statamic.sites'));
    $result = $sites->all();

    expect($result)->not->toBeNull();
});

test('getSavedSites caches result', function (): void {
    config(['statamic.builder.sites' => [
        TestSite::class,
    ]]);

    Cache::shouldReceive('rememberForever')
        ->once()
        ->with('statamic.builder.sites', \Mockery::type('Closure'))
        ->andReturnUsing(function ($key, $callback) {
            return $callback();
        });

    $sites = new Sites(config('statamic.sites'));
    $sites->all();
});

test('getSavedSites maps site classes to array with handle as key', function (): void {
    config(['statamic.builder.sites' => [
        TestSite::class,
    ]]);

    $sites = new Sites(config('statamic.sites'));
    $result = $sites->all();

    expect($result->first())->not->toBeNull()
        ->and($result->has('blog'))->toBeTrue();
});
