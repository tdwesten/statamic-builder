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
