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

        $items
            ->map(function ($item) {
                if ($item instanceof Fieldset) {
                    return $item;
                }

                return [$item];
            })
            ->flatten(1);

        return $items;
    }
}
