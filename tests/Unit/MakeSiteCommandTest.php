<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;

test('it can create a site', function (): void {
    $this->artisan('make:site', ['name' => 'TestSiteClass'])
        ->assertExitCode(0);

    $path = app_path('Sites/TestSiteClass.php');

    expect(File::exists($path))->toBeTrue();

    File::delete($path);
});

test('it shows registration reminder when auto_registration is false', function (): void {
    config(['statamic.builder.auto_registration' => false]);

    $this->artisan('make:site', ['name' => 'AnotherSiteClass'])
        ->expectsOutput('Remember to register your new Site in config/statamic/builder.php')
        ->assertExitCode(0);

    $path = app_path('Sites/AnotherSiteClass.php');
    File::delete($path);
});
