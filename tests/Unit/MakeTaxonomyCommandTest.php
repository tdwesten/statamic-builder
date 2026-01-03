<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;

test('it can create a taxonomy', function (): void {
    $this->artisan('make:taxonomy', ['name' => 'TagsTaxonomy'])
        ->assertExitCode(0);

    $path = app_path('Taxonomies/TagsTaxonomy.php');

    expect(File::exists($path))->toBeTrue();

    File::delete($path);
});
