<?php

use Statamic\Facades\Taxonomy;
use Tdwesten\StatamicBuilder\Exceptions\BlueprintRenderException;
use Tdwesten\StatamicBuilder\FieldTypes\Tab;
use Tdwesten\StatamicBuilder\FieldTypes\Text;
use Tdwesten\StatamicBuilder\Http\Controllers\TaxonomyBlueprintsController;
use Tests\Helpers\TestBlueprint;
use Tests\TestCase;

test('Has a title', function (): void {
    $blueprint = TestBlueprint::make('test_blueprint');

    expect($blueprint->toArray()['title'])->toBe(
        'Test Blueprint'
    );
});

it('can be set to hidden', function (): void {
    $blueprint = TestBlueprint::make('test_blueprint');
    $blueprint->hidden(true);

    expect($blueprint->toArray()['hide'])->toBe(true);
});

test('Tabs are renderd', function (): void {
    $blueprint = TestBlueprint::make('test_blueprint');

    $expected = [
        'title' => 'Test Blueprint',
        'hide' => false,
        'tabs' => [
            'main' => [
                'display' => 'Main',
                'sections' => [
                    [
                        'display' => 'General',
                        'fields' => [
                            [
                                'handle' => 'title',
                                'field' => [
                                    'antlers' => false,
                                    'duplicate' => true,
                                    'hide_display' => false,
                                    'input_type' => 'text',
                                    'instructions_position' => 'above',
                                    'listable' => 'visible',
                                    'localizable' => false,
                                    'replicator_preview' => true,
                                    'type' => 'text',
                                    'visibility' => 'visible',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    expect($blueprint->toArray())->toBe($expected);
});

it('throws an exception when adding a field to a tab', function (): void {
    $blueprint = TestBlueprint::make('test_blueprint');
    $blueprint
        ->title('School')
        ->addTab(Tab::make('main', [
            Text::make('name')->displayName('Name'),
        ]));

    $blueprint->toArray();
})->throws(BlueprintRenderException::class, 'Only sections are allowed in tabs');

test('you can set a title', function (): void {
    $blueprint = TestBlueprint::make('test_blueprint');
    $blueprint->title('School');

    expect($blueprint->toArray()['title'])->toBe('School');
});

test('you can get the handle', function (): void {
    $blueprint = TestBlueprint::make('test_blueprint');

    expect($blueprint->getHandle())->toBe('test_blueprint');
});

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

    /**
     * The issue we're testing for regards normal Statamic Taxonomy Blueprints
     * and their interaction with Statamic-Builder's controller.
     *
     * So, we'll need to make files for Statamic to load in during the test.
     * These will be removed in the ->after callback.
     */
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
    ->after(function () {
        function removeDir(string $dir): void
        {
            $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
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
            rmdir($dir);
        }

        removeDir(TEST_FILES_DIRECTORY);
    });
