<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection;
use Statamic\Globals\GlobalCollection;
use Statamic\Stache\Repositories\GlobalRepository as StatamicGlobalRepository;

class GlobalRepository extends StatamicGlobalRepository
{
    public function all(): GlobalCollection
    {
        $builderKeys = $this->findBlueprints('globals')->keys();

        $keys = $this->store->paths()->keys()->merge($builderKeys);

        return GlobalCollection::make($this->store->getItems($keys));
    }

    public static function findBlueprints($namespace): ?Collection
    {
        $registeredBlueprints = collect(config('statamic.builder.blueprints', []));

        if (! $registeredBlueprints->has($namespace)) {
            return null;
        }

        return collect($registeredBlueprints->get($namespace, null));
    }
}
