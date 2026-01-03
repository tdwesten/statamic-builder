<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;

test('it can create a site', function (): void {
    $this->artisan('make:site', ['name' => 'TestSiteClass'])
        ->assertExitCode(0);

    $path = app_path('Sites/TestSiteClass.php');

    expect(File::exists($path))->toBeTrue();

    File::delete($path);
});
