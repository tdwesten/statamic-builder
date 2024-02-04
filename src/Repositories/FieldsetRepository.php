<?php

namespace Tdwesten\StatamicBuilder\Repositories;

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
        $registeredFieldsets = config('builder.fieldsets', []);

        $fieldset = collect($registeredFieldsets)
            ->filter(function ($fieldsetClassName) use ($handle) {
                return (new $fieldsetClassName)->getSlug() === $handle;
            })
            ->first();

        if (! $fieldset) {
            return null;
        }

        return new $fieldset;
    }
}
