<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection;
use Statamic\Stache\Repositories\NavigationRepository as StatamicNavigationRepository;

class NavigationRepository extends StatamicNavigationRepository
{
    public function all(): Collection
    {
        $builderKeys = BlueprintRepository::findBlueprintInNamespace('navigation')->map(function ($blueprint) {
            return $blueprint->getHandle();
        });

        $keys = $this->store->paths()->keys()->merge($builderKeys)->unique();

        return $this->store->getItems($keys);
    }
}
