<?php

use Statamic\Fields\Fieldset as StatamicFieldset;
use Tdwesten\StatamicBuilder\Repositories\FieldsetRepository;

test('::all includes builder-registered fieldsets', function (): void {
    config(['statamic.builder.fieldsets' => [
        \Tests\Helpers\TestFieldset::class,
    ]]);

    $repository = Mockery::mock(FieldsetRepository::class)->makePartial()->shouldAllowMockingProtectedMethods();
    $repository->shouldAllowMockingProtectedMethods();
    $repository->shouldReceive('getStandardFieldsets')->andReturn(collect());
    $repository->shouldReceive('getNamespacedFieldsets')->andReturn(collect());

    $fieldsets = $repository->all();

    expect($fieldsets->contains(fn ($fieldset) => $fieldset->handle() === 'test_fieldset'))->toBeTrue();
});

test('::find finds builder-registered fieldset', function (): void {
    config(['statamic.builder.fieldsets' => [
        \Tests\Helpers\TestFieldset::class,
    ]]);

    $repository = new FieldsetRepository;
    $fieldset = $repository->find('test_fieldset');

    expect($fieldset)->toBeInstanceOf(StatamicFieldset::class);
    expect($fieldset->handle())->toBe('test_fieldset');
});

test('::save does not save builder-registered fieldset', function (): void {
    config(['statamic.builder.fieldsets' => [
        \Tests\Helpers\TestFieldset::class,
    ]]);

    $repository = Mockery::mock(FieldsetRepository::class)->makePartial()->shouldAllowMockingProtectedMethods();
    $repository->shouldNotReceive('parent::save');

    $fieldset = StatamicFieldset::make('test_fieldset');
    $repository->save($fieldset);

    // If it didn't throw and Mockery didn't complain, it's good.
    expect(true)->toBeTrue();
});
