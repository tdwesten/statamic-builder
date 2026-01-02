<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection as IlluminateCollection;
use Statamic\Globals\GlobalCollection;
use Statamic\Globals\GlobalSet;
use Statamic\Stache\Repositories\GlobalRepository as StatamicGlobalRepository;
use Statamic\Stache\Stache;
use Tdwesten\StatamicBuilder\BaseGlobalSet;

class GlobalRepository extends StatamicGlobalRepository
{
    /**
     * @var IlluminateCollection
     */
    private $globals;

    public function __construct(Stache $stache)
    {
        parent::__construct($stache);

        $this->initializeGlobals();
    }

    public function all(): GlobalCollection
    {
        $blueprints = BlueprintRepository::findBlueprintInNamespace('globals');

        $builderKeys = $blueprints->map(function ($blueprint) {
            return $blueprint->getHandle();
        });

        $keys = $this->store->paths()->keys()->merge($builderKeys)->merge($this->globals->keys())->unique();

        $items = $this->store->getItems($keys, $this->globals)->map(function ($item, $key) use ($blueprints) {
            if ($item) {
                return $item;
            }

            $blueprint = $blueprints->get($key);

            if ($blueprint) {
                $global = \Statamic\Facades\GlobalSet::make($key)
                    ->title($blueprint->toArray()['title'] ?? null);

                foreach (\Statamic\Facades\Site::all() as $site) {
                    $global->addLocalization($global->makeLocalization($site->handle()));
                }

                return $global;
            }

            return null;
        })->filter();

        return GlobalCollection::make($items);
    }

    public function find($id): ?GlobalSet
    {
        if ($global = $this->globals->get($id)) {
            return (new $global)->register();
        }

        return parent::find($id);
    }

    private function initializeGlobals()
    {
        $globals = collect(config('statamic.builder.globals', []));

        $this->globals = collect();

        $globals->each(function (string $set): void {
            if (class_exists($set, true)) {
                $this->globals->put($set::handle(), $set);
            }
        });
    }

    public function findByHandle($handle): ?GlobalSet
    {
        $set = $this->globals->get($handle);

        if ($set) {
            return (new $set)->register();
        }

        return parent::findByHandle($handle);
    }

    public function getGlobalByHandle($handle): ?BaseGlobalSet
    {
        $global = $this->globals->get($handle, null);

        if ($global) {
            return new $global;
        }

        return null;
    }
}
