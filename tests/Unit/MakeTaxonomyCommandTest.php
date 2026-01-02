<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

pest()->extend(TestCase::class);

test('it can create a taxonomy', function () {
    $this->artisan('make:taxonomy', ['name' => 'TagsTaxonomy'])
        ->assertExitCode(0);

    $path = app_path('Taxonomies/TagsTaxonomy.php');

    expect(File::exists($path))->toBeTrue();

    File::delete($path);
});
