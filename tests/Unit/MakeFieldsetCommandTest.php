<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

pest()->extend(TestCase::class);

test('it can create a fieldset', function () {
    $this->artisan('make:fieldset', ['name' => 'CommonFieldset'])
        ->assertExitCode(0);

    $path = app_path('Fieldsets/CommonFieldset.php');

    expect(File::exists($path))->toBeTrue();

    File::delete($path);
});
