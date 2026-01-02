<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

pest()->extend(TestCase::class);

test('it can create a blueprint', function () {
    $this->artisan('make:blueprint', ['name' => 'TestBlueprint'])
        ->assertExitCode(0);

    $path = app_path('Blueprints/TestBlueprint.php');

    expect(File::exists($path))->toBeTrue();

    File::delete($path);
});
