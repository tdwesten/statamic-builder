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
