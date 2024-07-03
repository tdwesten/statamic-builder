<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection;
use Statamic\Eloquent\Structures\NavigationRepository as StatamicNavigationRepository;
use Tdwesten\StatamicBuilder\Repositories\BlueprintRepository;
use Statamic\Contracts\Structures\Nav as NavContract;
use Statamic\Eloquent\Structures\NavModel;

class EloquentNavigationRepository extends StatamicNavigationRepository
{
    public function all(): Collection
    {
        $builderKeys = BlueprintRepository::findBlueprintInNamespace('navigation')->transform(function ($value, $key) {
            $model = new NavModel($value->toArray());

            return app(NavContract::class)->fromModel($model);
        });

        return $builderKeys;
    }

    public function find($id): ?NavContract
    {
        return $this->all()->filter(function ($value, $key) use ($id) {
            return ($key === $id);
        })->first();
    }

    public function findByHandle($handle): ?NavContract
    {
        return $this->find($handle);
    }
}
