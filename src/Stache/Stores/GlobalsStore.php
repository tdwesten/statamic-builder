<?php

namespace Tdwesten\StatamicBuilder\Stache\Stores;

use Illuminate\Support\Collection;
use Statamic\Stache\Stores\GlobalsStore as StatamicGlobalsStore;
use Tdwesten\StatamicBuilder\BaseGlobalSet;

class GlobalsStore extends StatamicGlobalsStore
{
    public function getItem($key, $globals = null)
    {
        /** @var Collection */
        $globals = $globals ?? collect([]);

        if ($globals->has($key)) {
            /** @var BaseGlobalSet */
            $globalSet = $globals->get($key);
            $globalSet = new $globalSet();

            if (! $globalSet instanceof BaseGlobalSet) {
                throw new \Exception("Global Set [{$key}] must extend [Tdwesten\StatamicBuilder\BaseGlobalSet]");
            }

            $item = $globalSet->register();

            $this->cacheItem($item);

            return $item;
        }

        return parent::getItem($key);
    }

    public function getItems($keys, $globals = null)
    {
        $this->handleFileChanges();

        return collect($keys)->map(function ($key) use ($globals) {
            return $this->getItem($key, $globals);
        });
    }
}
