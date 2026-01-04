<?php

namespace Tdwesten\StatamicBuilder\Stache\Stores;

use Illuminate\Support\Collection;
use Statamic\Stache\Stores\CollectionsStore as StatamicCollectionsStore;
use Tdwesten\StatamicBuilder\BaseCollection;

class CollectionsStore extends StatamicCollectionsStore
{
    public function getItem($key, $collections = null)
    {
        /** @var Collection */
        $collections = $collections ?? collect([]);

        if ($collections->has($key)) {
            /** @var BaseCollection */
            $collection = $collections->get($key);
            $collection = new $collection($key);

            if (! $collection instanceof BaseCollection) {
                throw new \Exception("Collection [{$key}] must extend [Tdwesten\StatamicBuilder\BaseCollection]");
            }

            $item = $collection->register();

            $this->cacheItem($item);

            return $item;
        }

        return parent::getItem($key);
    }

    public function getItems($keys, $collections = null)
    {
        $this->handleFileChanges();

        return collect($keys)->mapWithKeys(function ($key) use ($collections) {
            return [$key => $this->getItem($key, $collections)];
        });
    }
}
