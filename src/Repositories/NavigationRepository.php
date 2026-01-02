<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection;
use Statamic\Contracts\Structures\Nav;
use Statamic\Stache\Repositories\NavigationRepository as StatamicNavigationRepository;
use Statamic\Stache\Stache;
use Tdwesten\StatamicBuilder\BaseNavigation;

class NavigationRepository extends StatamicNavigationRepository
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
        $blueprints = BlueprintRepository::findBlueprintInNamespace('navigation');

        $builderKeys = $blueprints->map(function ($blueprint) {
            return $blueprint->getHandle();
        });

        $keys = $this->store->paths()->keys()->merge($builderKeys)->merge($this->navigations->keys())->unique();

        return $this->store->getItems($keys, $this->navigations)->map(function ($item, $key) use ($blueprints) {
            if ($item) {
                return $item;
            }

            $blueprint = $blueprints->get($key);

            if ($blueprint) {
                $nav = \Statamic\Facades\Nav::make($key)
                    ->title($blueprint->toArray()['title'] ?? null);

                $nav->sites(\Statamic\Facades\Site::all()->map->handle()->all());

                return $nav;
            }

            return null;
        })->filter();
    }

    public function findByHandle($handle): ?Nav
    {
        $navigation = $this->navigations->get($handle);

        if ($navigation) {
            return (new $navigation)->register();
        }

        return parent::findByHandle($handle);
    }

    public function getNavigationByHandle($handle): ?BaseNavigation
    {
        $navigation = $this->navigations->get($handle, null);

        if ($navigation) {
            return new $navigation;
        }

        return null;
    }
}
