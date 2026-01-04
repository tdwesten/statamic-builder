<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;

test('it can create a collection', function (): void {
    $this->artisan('make:collection', ['name' => 'BlogCollection'])
        ->assertExitCode(0);

    $path = app_path('Collections/BlogCollection.php');

    expect(File::exists($path))->toBeTrue();

    File::delete($path);
});

test('it shows registration reminder when auto_registration is false', function (): void {
    config(['statamic.builder.auto_registration' => false]);

    $this->artisan('make:collection', ['name' => 'AnotherCollection'])
        ->expectsOutput('Remember to register your new Collection in config/statamic/builder.php')
        ->assertExitCode(0);

    $path = app_path('Collections/AnotherCollection.php');
    File::delete($path);
});
