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
        $keys = $this->store->paths()->keys();

        // add custom globals
        $keys = $this->globals->keys()->merge($keys);

        return GlobalCollection::make($this->store->getItems($keys, $this->globals));
    }

    public function find($id): ?GlobalSet
    {
        if ($global = $this->globals->get($id)) {
            return (new $global)->register();
        }

        $r = parent::find($id);

        if ($r) {
            return $r;
        }
    }

    private function initializeGlobals()
    {
        $globals = collect(config('statamic.builder.globals', []));

        $this->globals = collect();

        $globals->each(function (string $set) {
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
