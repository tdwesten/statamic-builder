<?php

namespace Tdwesten\StatamicBuilder\Helpers;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Fieldset;
use Tdwesten\StatamicBuilder\FieldTypes\Field;

class FieldParser
{
    /**
     * Parse mixed fields (Fieldsets/Fields) to flat collection.
     */
    public static function parseMixedFieldsToFlatCollection($items): Collection
    {
        $items = collect($items);

        $fieldsets = $items->filter(function ($field) {
            return $field instanceof Fieldset;
        })->flatten();

        $fields = $items->filter(function ($field) {
            return $field instanceof Field;
        });

        $items = collect($fieldsets)->merge($fields);

        return $items;
    }
}
