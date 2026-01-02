<?php

use Tdwesten\StatamicBuilder\Repositories\TaxonomyRepository;
use Tests\TestCase;

pest()->extend(TestCase::class);

test('::all includes builder-registered taxonomies', function () {
    config(['statamic.builder.taxonomies' => [
        \Tests\Helpers\TestTaxonomy::class,
    ]]);

    $repository = new TaxonomyRepository(app('stache'));
    $taxonomies = $repository->all();

    expect($taxonomies->has('test_taxonomy'))->toBeTrue();
});

test('::findByHandle finds builder-registered taxonomy', function () {
    config(['statamic.builder.taxonomies' => [
        \Tests\Helpers\TestTaxonomy::class,
    ]]);

    $repository = new TaxonomyRepository(app('stache'));
    $taxonomy = $repository->findByHandle('test_taxonomy');

    expect($taxonomy)->not()->toBeNull();
    expect($taxonomy->handle())->toBe('test_taxonomy');
});
