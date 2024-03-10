<?php

namespace Tdwesten\StatamicBuilder\Stache\Stores;

use Illuminate\Support\Collection;
use Statamic\Facades\Path;
use Statamic\Stache\Stores\CollectionsStore as StatamicCollectionsStore;
use Symfony\Component\Finder\SplFileInfo;
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

        return collect($keys)->map(function ($key) use ($collections) {
            return $this->getItem($key, $collections);
        });
    }

    // public function getItemFilter(SplFileInfo $file)
    // {
    //     /** @var Collection */
    //     $files = parent::getItemFilter($file) ?? collect([]);

    //     $collections = $this->getCollections();

    //     $collections = $collections->map(function ($collection) {
    //         $file = (new \ReflectionClass($collection))->getFileName();

    //         $file = new SplFileInfo($file, '', '');

    //         return [Path::tidy($file->getPathname()) => $file->getMTime()];
    //     });

    //     return $files->merge($collections);

    // }

    // public function getCollections(): Collection
    // {
    //     $collections = collect(config('builder.collections'), []);

    //     return $collections;
    // }
}
