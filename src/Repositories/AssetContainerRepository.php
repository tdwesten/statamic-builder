<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection;
use Statamic\Stache\Repositories\AssetContainerRepository as StatamicAssetContainerRepository;

class AssetContainerRepository extends StatamicAssetContainerRepository
{
    public function all(): Collection
    {
        $builderKeys = BlueprintRepository::findBlueprintInNamespace('assets')->map(function ($blueprint) {
            return $blueprint->getHandle();
        });

        $keys = $this->store->paths()->keys()->merge($builderKeys)->unique();

        return $this->store->getItems($keys)->filter();
    }
}
