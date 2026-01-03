<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

pest()->extend(TestCase::class);

test('it can create a site', function () {
    $this->artisan('make:site', ['name' => 'TestSiteClass'])
        ->assertExitCode(0);

    $path = app_path('Sites/TestSiteClass.php');

    expect(File::exists($path))->toBeTrue();

    File::delete($path);
});
