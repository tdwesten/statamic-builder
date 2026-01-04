<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;

test('it can generate a navigation class', function (): void {
    $name = 'MainNavigation';
    $this->artisan('make:navigation', ['name' => $name]);

    $path = app_path('Navigations/MainNavigation.php');

    expect(File::exists($path))->toBeTrue();

    $content = File::get($path);

    expect($content)->toContain('class MainNavigation extends BaseNavigation');
    expect($content)->toContain("return 'main_navigation';");

    File::deleteDirectory(app_path('Navigations'));
});

test('it shows registration reminder when auto_registration is false', function (): void {
    config(['statamic.builder.auto_registration' => false]);

    $this->artisan('make:navigation', ['name' => 'FooterNavigation'])
        ->expectsOutput('Remember to register your new Navigation in config/statamic/builder.php')
        ->assertExitCode(0);

    File::deleteDirectory(app_path('Navigations'));
});
