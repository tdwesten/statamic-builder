<?php

use Tdwesten\StatamicBuilder\Repositories\TaxonomyRepository;

test('::all includes builder-registered taxonomies', function (): void {
    config(['statamic.builder.taxonomies' => [
        \Tests\Helpers\TestTaxonomy::class,
    ]]);

    $repository = new TaxonomyRepository(app('stache'));
    $taxonomies = $repository->all();

    expect($taxonomies->has('test_taxonomy'))->toBeTrue();
});

test('::findByHandle finds builder-registered taxonomy', function (): void {
    config(['statamic.builder.taxonomies' => [
        \Tests\Helpers\TestTaxonomy::class,
    ]]);

    $repository = new TaxonomyRepository(app('stache'));
    $taxonomy = $repository->findByHandle('test_taxonomy');

    expect($taxonomy)->not()->toBeNull();
    expect($taxonomy->handle())->toBe('test_taxonomy');
});

test('getTaxonomyByHandle returns null for non-existent taxonomy', function (): void {
    config(['statamic.builder.taxonomies' => []]);

    $repository = new TaxonomyRepository(app('stache'));
    $result = $repository->getTaxonomyByHandle('non-existent');

    expect($result)->toBeNull();
});

test('getTaxonomyByHandle returns taxonomy instance for valid handle', function (): void {
    config(['statamic.builder.taxonomies' => [
        \Tests\Helpers\TestTaxonomy::class,
    ]]);

    $repository = new TaxonomyRepository(app('stache'));
    $result = $repository->getTaxonomyByHandle('test_taxonomy');

    expect($result)->not()->toBeNull()
        ->and($result)->toBeInstanceOf(\Tests\Helpers\TestTaxonomy::class);
});
