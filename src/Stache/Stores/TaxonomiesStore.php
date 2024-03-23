<?php

namespace Tdwesten\StatamicBuilder\Stache\Stores;

use Illuminate\Support\Collection;
use Statamic\Stache\Stores\TaxonomiesStore as StatamicTaxonomiesStore;
use Tdwesten\StatamicBuilder\BaseTaxonomy;

class TaxonomiesStore extends StatamicTaxonomiesStore
{
    public function getItem($key, $taxonomies = null)
    {
        /** @var Collection */
        $taxonomies = $taxonomies ?? collect([]);

        if ($taxonomies->has($key)) {
            /** @var BaseTaxonomy */
            $collection = $taxonomies->get($key);
            $collection = new $collection($key);

            if (! $collection instanceof BaseTaxonomy) {
                throw new \Exception("Collection [{$key}] must extend [Tdwesten\StatamicBuilder\BaseTaxonomy]");
            }

            $item = $collection->register();

            $this->cacheItem($item);

            return $item;
        }

        return parent::getItem($key);
    }

    public function getItems($keys, $taxonomies = null)
    {
        $this->handleFileChanges();

        return collect($keys)->map(function ($key) use ($taxonomies) {
            return $this->getItem($key, $taxonomies);
        });
    }
}
