<?php

use Statamic\Facades\Taxonomy;
use Tdwesten\StatamicBuilder\Http\Controllers\TaxonomyBlueprintsController;
use Tests\TestCase;

pest()->extend(TestCase::class);

const TEST_FILES_DIRECTORY = __DIR__.'/../__fixtures__';
const TAX_DIRECTORY = TEST_FILES_DIRECTORY.'/content/taxonomies';
const TEST_TAX_BLUEPRINTS_DIRECTORY = TEST_FILES_DIRECTORY.'/resources/blueprints/taxonomies/test_tax';

test('taxonomy blueprints can be edited', function (): void {

    // Prepare fixtures directory
    if (! (is_dir(TEST_FILES_DIRECTORY) && is_dir(TAX_DIRECTORY) && is_dir(TEST_TAX_BLUEPRINTS_DIRECTORY))) {
        $created = mkdir(TAX_DIRECTORY, recursive: true)
            && mkdir(TEST_TAX_BLUEPRINTS_DIRECTORY, recursive: true);

        if (! $created) {
            $this->fail('Could not create test files directory (in '.TEST_FILES_DIRECTORY.')');
        }
    }

    $test_tax_blueprint = <<<'BLUEPRINT'
title: Test_Taxonomy_Blueprint
    tabs:
      main:
        display: Main
        sections:
          -
            fields:
              -
                handle: title
                field:
                  type: text
                  required: true
                  validate:
                    - required
BLUEPRINT;

    $test_tax = <<<'TAXONOMY'
title: Test_Tax
TAXONOMY;

    file_put_contents(TAX_DIRECTORY.'/test_tax.yaml', $test_tax);
    file_put_contents(TEST_TAX_BLUEPRINTS_DIRECTORY.'/test_tax.yaml', $test_tax_blueprint);

    // Create a new controller and attempt to edit the taxonomy blueprint with it
    (new TaxonomyBlueprintsController)->edit(Taxonomy::findByHandle('test_tax'), 'test_tax');
})
    ->throwsNoExceptions()
    ->after(function (): void {
        $it = new RecursiveDirectoryIterator(TEST_FILES_DIRECTORY, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator(
            $it,
            RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getPathname());
            } else {
                unlink($file->getPathname());
            }
        }
        rmdir(TEST_FILES_DIRECTORY);
    });
