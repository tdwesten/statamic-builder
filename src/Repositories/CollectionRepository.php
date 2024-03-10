<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection as IlluminateCollection;
use Statamic\Entries\Collection;
use Statamic\Stache\Repositories\CollectionRepository as StatamicCollectionRepository;
use Statamic\Stache\Stache;

class CollectionRepository extends StatamicCollectionRepository
{
    private $collections;

    public function __construct(Stache $stache)
    {
        parent::__construct($stache);

        $this->initializeCollections();
    }

    private function initializeCollections()
    {
        $collections = collect(config('statamic.builder.collections', []));

        $this->collections = collect();

        $collections->each(function (string $collection) {
            if (class_exists($collection, true)) {
                $this->collections->put($collection::handle(), $collection);
            }
        });
    }

    public function all(): IlluminateCollection
    {
        $keys = $this->store->paths()->keys();

        // add custom collections
        $keys = $this->collections->keys()->merge($keys);

        return $this->store->getItems($keys, $this->collections);
    }

    public function findByHandle($handle): ?Collection
    {
        $collection = $this->collections->get($handle);

        if ($collection) {
            return (new $collection)->register();
        }

        return parent::findByHandle($handle);
    }
}
