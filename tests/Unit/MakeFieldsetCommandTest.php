<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;

test('it can create a fieldset', function (): void {
    $this->artisan('make:fieldset', ['name' => 'CommonFieldset'])
        ->assertExitCode(0);

    $path = app_path('Fieldsets/CommonFieldset.php');

    expect(File::exists($path))->toBeTrue();

    File::delete($path);
});

test('it shows registration reminder when auto_registration is false', function (): void {
    config(['statamic.builder.auto_registration' => false]);

    $this->artisan('make:fieldset', ['name' => 'AnotherFieldset'])
        ->expectsOutput('Remember to register your new Fieldset in config/statamic/builder.php')
        ->assertExitCode(0);

    $path = app_path('Fieldsets/AnotherFieldset.php');
    File::delete($path);
});
