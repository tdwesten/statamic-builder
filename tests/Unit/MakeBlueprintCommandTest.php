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
