<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

pest()->extend(TestCase::class);

test('it can create a collection', function () {
    $this->artisan('make:collection', ['name' => 'BlogCollection'])
        ->assertExitCode(0);

    $path = app_path('Collections/BlogCollection.php');

    expect(File::exists($path))->toBeTrue();

    File::delete($path);
});
