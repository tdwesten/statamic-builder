<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection;
use Statamic\Fields\Fieldset as StatamicFieldset;
use Statamic\Fields\FieldsetRepository as FieldsFieldsetRepository;
use Tdwesten\StatamicBuilder\Fieldset;

class FieldsetRepository extends FieldsFieldsetRepository
{
    public function find(string $handle): ?StatamicFieldset
    {
        $builderFieldset = $this->findFieldset($handle);

        if (! $builderFieldset) {
            return parent::find($handle);
        }

        return $this
            ->make($handle)
            ->initialPath(resource_path('fieldsets'))
            ->setContents($builderFieldset->fieldsetToArray());
    }

    public function findFieldset(string $handle): ?Fieldset
    {
        $registeredFieldsets = config('statamic.builder.fieldsets', []);

        $fieldset = collect($registeredFieldsets)
            ->filter(function ($fieldsetClassName) use ($handle) {
                if (empty($fieldsetClassName)) {
                    return false;
                }

                if (! class_exists($fieldsetClassName)) {
                    return false;
                }

                return (new $fieldsetClassName)->getSlug() === $handle;
            })
            ->first();

        if (! $fieldset) {
            return null;
        }

        return new $fieldset;
    }

    public function all(): Collection
    {
        return collect([
            ...$this->getStandardFieldsets(),
            ...$this->getNamespacedFieldsets(),
            ...array_map(function ($fieldset) {
                $fieldset = new $fieldset;

                return $this
                    ->make($fieldset->getSlug())
                    ->initialPath(resource_path('fieldsets'))
                    ->setContents($fieldset->fieldsetToArray());
            }, config('statamic.builder.fieldsets', [])),
        ]);
    }

    public function save(StatamicFieldset $fieldset)
    {
        if ($this->findFieldset($fieldset->handle())) {
            // Fieldsets from statamic-builder should not be saved
            return;
        }

        parent::save($fieldset);
    }
}
