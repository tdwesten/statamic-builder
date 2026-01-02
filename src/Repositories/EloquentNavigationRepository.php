<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection;
use Statamic\Contracts\Structures\Nav as NavContract;
use Statamic\Eloquent\Structures\NavigationRepository as StatamicNavigationRepository;
use Statamic\Eloquent\Structures\NavModel;
use Statamic\Stache\Stache;

class EloquentNavigationRepository extends StatamicNavigationRepository
{
    /**
     * @var Collection
     */
    private $navigations;

    public function __construct(Stache $stache)
    {
        parent::__construct($stache);

        $this->initializeNavigations();
    }

    private function initializeNavigations()
    {
        $navigations = collect(config('statamic.builder.navigations', []));

        $this->navigations = collect();

        $navigations->each(function (string $navigation): void {
            if (class_exists($navigation, true)) {
                $this->navigations->put($navigation::handle(), $navigation);
            }
        });
    }

    public function all(): Collection
    {
        $builderKeys = BlueprintRepository::findBlueprintInNamespace('navigation')->transform(function ($value, $key) {
            $model = new NavModel($value->toArray());

            return app(NavContract::class)->fromModel($model);
        });

        $customNavigations = $this->navigations->map(function ($navigation) {
            return (new $navigation)->register();
        });

        return $builderKeys->merge($customNavigations);
    }

    public function find($id): ?NavContract
    {
        return $this->all()->filter(function ($value, $key) use ($id) {
            return $key === $id;
        })->first();
    }

    public function findByHandle($handle): ?NavContract
    {
        return $this->find($handle);
    }
}
