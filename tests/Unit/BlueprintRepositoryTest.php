<?php

use Statamic\Fields\Blueprint as StatamicBlueprint;
use Tdwesten\StatamicBuilder\Repositories\BlueprintRepository;
use Tests\Helpers\TestBlueprint;
use Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    // Register test blueprint
    config([
        'statamic.builder.blueprints' => [
            'collections.test' => [
                'test_blueprint' => TestBlueprint::class,
            ],
        ],
    ]);
});

test('makeBlueprintFromFile works with old directory property', function (): void {
    $repository = new class extends BlueprintRepository
    {
        protected $directory = 'resources/blueprints';

        public function testMakeBlueprintFromFile($path, $namespace = null)
        {
            return $this->makeBlueprintFromFile($path, $namespace);
        }
    };

    $path = 'resources/blueprints/collections/test/test_blueprint.yaml';
    $result = $repository->testMakeBlueprintFromFile($path, 'collections.test');

    expect($result)->toBeInstanceOf(StatamicBlueprint::class);
    expect($result->handle())->toBe('test_blueprint');
});

test('makeBlueprintFromFile works with new directories property (array)', function (): void {
    $repository = new class extends BlueprintRepository
    {
        protected $directories = ['resources/blueprints'];

        public function testMakeBlueprintFromFile($path, $namespace = null)
        {
            return $this->makeBlueprintFromFile($path, $namespace);
        }
    };

    $path = 'resources/blueprints/collections/test/test_blueprint.yaml';
    $result = $repository->testMakeBlueprintFromFile($path, 'collections.test');

    expect($result)->toBeInstanceOf(StatamicBlueprint::class);
    expect($result->handle())->toBe('test_blueprint');
});

test('makeBlueprintFromFile handles multiple directories and uses first one', function (): void {
    $repository = new class extends BlueprintRepository
    {
        protected $directories = ['resources/blueprints', 'additional/blueprints'];

        public function testMakeBlueprintFromFile($path, $namespace = null)
        {
            return $this->makeBlueprintFromFile($path, $namespace);
        }
    };

    $path = 'resources/blueprints/collections/test/test_blueprint.yaml';
    $result = $repository->testMakeBlueprintFromFile($path, 'collections.test');

    expect($result)->toBeInstanceOf(StatamicBlueprint::class);
    expect($result->handle())->toBe('test_blueprint');
});

test('makeBlueprintFromFile falls back to directory when directories is empty', function (): void {
    $repository = new class extends BlueprintRepository
    {
        protected $directory = 'resources/blueprints';

        protected $directories = [];

        public function testMakeBlueprintFromFile($path, $namespace = null)
        {
            return $this->makeBlueprintFromFile($path, $namespace);
        }
    };

    $path = 'resources/blueprints/collections/test/test_blueprint.yaml';
    $result = $repository->testMakeBlueprintFromFile($path, 'collections.test');

    expect($result)->toBeInstanceOf(StatamicBlueprint::class);
    expect($result->handle())->toBe('test_blueprint');
});

test('repository can find blueprints correctly', function (): void {
    $repository = app(BlueprintRepository::class);

    $blueprint = $repository->find('collections/test.test_blueprint');

    expect($blueprint)->toBeInstanceOf(StatamicBlueprint::class);
    expect($blueprint->handle())->toBe('test_blueprint');
    expect($blueprint->namespace())->toBe('collections.test');
});
