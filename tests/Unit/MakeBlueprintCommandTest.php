<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;

test('it can create a blueprint', function (): void {
    $this->artisan('make:blueprint', ['name' => 'TestBlueprint'])
        ->assertExitCode(0);

    $path = app_path('Blueprints/TestBlueprint.php');

    expect(File::exists($path))->toBeTrue();

    File::delete($path);
});

test('it shows registration reminder when auto_registration is false', function (): void {
    config(['statamic.builder.auto_registration' => false]);

    $this->artisan('make:blueprint', ['name' => 'AnotherBlueprint'])
        ->expectsOutput('Remember to register your new Blueprint in config/statamic/builder.php')
        ->assertExitCode(0);

    $path = app_path('Blueprints/AnotherBlueprint.php');
    File::delete($path);
});
