<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Statamic\Globals\GlobalCollection;
use Statamic\Stache\Repositories\GlobalRepository as StatamicGlobalRepository;

class GlobalRepository extends StatamicGlobalRepository
{
    public function all(): GlobalCollection
    {
        $builderKeys = BlueprintRepository::findBlueprintInNamespace('globals')->map(function ($blueprint) {
            return $blueprint->getHandle();
        });

        $keys = $this->store->paths()->keys()->merge($builderKeys);

        return GlobalCollection::make($this->store->getItems($keys));
    }
}
