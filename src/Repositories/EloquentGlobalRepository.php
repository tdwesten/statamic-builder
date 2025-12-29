<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection as IlluminateCollection;
use Statamic\Eloquent\Globals\GlobalRepository as StatamicEloquentGlobalRepository;
use Statamic\Globals\GlobalCollection;
use Statamic\Globals\GlobalSet;
use Tdwesten\StatamicBuilder\BaseGlobalSet;

class EloquentGlobalRepository extends StatamicEloquentGlobalRepository
{
    /**
     * @var IlluminateCollection
     */
    private $globals;

    public function __construct()
    {
        parent::__construct();

        $this->initializeGlobals();
    }

    public function all(): GlobalCollection
    {
        // Get builder-registered globals, keyed by handle
        $builderGlobals = $this->globals->map(function ($globalClass, $handle) {
            return (new $globalClass)->register();
        });

        // Merge with database globals
        $databaseGlobals = parent::all();

        // Combine both collections - builder globals take precedence
        $allGlobals = $databaseGlobals->merge($builderGlobals);

        return $allGlobals;
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
