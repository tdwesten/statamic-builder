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

test('it shows registration reminder when auto_registration is false', function (): void {
    config(['statamic.builder.auto_registration' => false]);

    $this->artisan('make:taxonomy', ['name' => 'CategoriesTaxonomy'])
        ->expectsOutput('Remember to register your new Taxonomy in config/statamic/builder.php')
        ->assertExitCode(0);

    $path = app_path('Taxonomies/CategoriesTaxonomy.php');
    File::delete($path);
});
