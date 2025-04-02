<?php

namespace Tdwesten\StatamicBuilder\Helpers;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Fieldset;

class FieldParser
{
    /**
     * Parse mixed fields (Fieldsets/Fields) to flat collection.
     */
    public static function parseMixedFieldsToFlatCollection($items): Collection
    {
        $items = collect($items);

        return $items->map(function ($field) {
            if ($field instanceof Fieldset) {
                return $field->getFields();
            }

            return $field;
        })->flatten(1);
    }
}
