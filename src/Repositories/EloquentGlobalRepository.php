<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection as IlluminateCollection;
use Statamic\Eloquent\Globals\GlobalRepository as StatamicEloquentGlobalRepository;
use Statamic\Facades\GlobalSet as StatamicGlobalSet;
use Statamic\Globals\GlobalCollection;
use Statamic\Globals\GlobalSet;
use Statamic\Stache\Stache;
use Tdwesten\StatamicBuilder\BaseGlobalSet;

class EloquentGlobalRepository extends StatamicEloquentGlobalRepository
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
        // Get database globals
        $databaseGlobals = parent::all();

        // Get builder-registered global instances from classes, keyed by handle
        $builderGlobals = $this->globals->map(function ($globalClass, $handle) {
            return (new $globalClass)->register();
        });

        $blueprints = BlueprintRepository::findBlueprintInNamespace('globals');

        $builderKeys = $blueprints
            ->reject(function ($value, $handle) use ($databaseGlobals, $builderGlobals) {
                return $databaseGlobals->has($handle) || $builderGlobals->has($handle);
            })
            ->map(function ($value) {
                $contents = $value->toArray();
                $global = StatamicGlobalSet::make($value->getHandle())
                    ->title($contents['title'] ?? null);

                foreach (\Statamic\Facades\Site::all() as $site) {
                    $global->addLocalization($global->makeLocalization($site->handle()));
                }

                return $global;
            });

        // Combine both collections - builder globals take precedence
        return $databaseGlobals->merge($builderKeys)->merge($builderGlobals);
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
