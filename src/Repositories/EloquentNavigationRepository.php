<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection;
use Statamic\Contracts\Structures\Nav as NavContract;
use Statamic\Eloquent\Structures\NavigationRepository as StatamicNavigationRepository;
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
        // Get database navigations, gracefully handling missing table
        try {
            $databaseNavigations = parent::all();
        } catch (\Illuminate\Database\QueryException $e) {
            $databaseNavigations = collect();
        }

        // Get builder-registered navigation instances from classes, keyed by handle
        $customNavigations = $this->navigations->map(function ($navigation) {
            return (new $navigation)->register();
        });

        $blueprints = BlueprintRepository::findBlueprintInNamespace('navigation');

        $builderKeys = $blueprints
            ->reject(function ($value, $handle) use ($databaseNavigations, $customNavigations) {
                return $databaseNavigations->has($handle) || $customNavigations->has($handle);
            })
            ->map(function ($value) {
                $contents = $value->toArray();
                $nav = \Statamic\Facades\Nav::make($value->getHandle())
                    ->title($contents['title'] ?? null);

                $nav->sites(\Statamic\Facades\Site::all()->map->handle()->all());

                return $nav;
            });

        // Ensure the collection is keyed by navigation handle so find/findByHandle work.
        return $databaseNavigations
            ->merge($builderKeys)
            ->merge($customNavigations)
            ->keyBy(function ($nav) {
                return method_exists($nav, 'handle') ? $nav->handle() : null;
            })
            ->filter();
    }

    public function find($id): ?NavContract
    {
         // `all()` is keyed by handle.
        return $this->all()->get($id);
    }

    public function findByHandle($handle): ?NavContract
    {
        return $this->find($handle);
    }

    public function getNavigationByHandle($handle): ?\Tdwesten\StatamicBuilder\BaseNavigation
    {
        $navigation = $this->navigations->get($handle, null);

        if ($navigation) {
            return new $navigation;
        }

        return null;
    }
}
